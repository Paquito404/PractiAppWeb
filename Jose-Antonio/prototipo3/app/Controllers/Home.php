<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

use App\Models\EscuelaModel;
use App\Models\AlumnoModel;
use App\Models\MaestroModel;
use App\Models\CoordinadorModel;
use App\Models\ModeradorModel;
use App\Models\Tabla1Model;
use App\Models\Tabla2Model;
use App\Models\Tabla3Model;

class Home extends BaseController
{
    //---------------------- Login -------------------------//

    public function index()
    {   

        return view('Login');

    }

    public function login(){

        $alumnoModel = new AlumnoModel();
        $maestroModel = new MaestroModel();
        $coordinadorModel = new CoordinadorModel();
        $moderadorModel = new ModeradorModel();

        $correo = $this->request->getPost('correo');
        $contraseña = $this->request->getPost('password');

        $alumno = $alumnoModel->where('correo', $correo)->first();
        $maestro = $maestroModel->where('correo', $correo)->first();
        $coordinador = $coordinadorModel->where('correo', $correo)->first();
        $moderador = $moderadorModel->where('correo', $correo)->first();

        if ($alumno && $alumno['password'] === $contraseña) {
            session()->set([
                'usuario_id' => $alumno['ID'],
                'nombre' => $alumno['nombre'],
                'tipo' => 'alumno',
                'logged_in' => true
            ], $alumno['ID']);
            return redirect()->to('/alumno');
        }

        if ($maestro && $maestro['password'] === $contraseña) {
            session()->set([
                'usuario_id' => $maestro['ID'],
                'nombre' => $maestro['nombre'],
                'tipo' => 'maestro',
                'logged_in' => true
            ], $maestro['ID']);
            return redirect()->to('/maestro');
        }

        if ($coordinador && $coordinador['password'] === $contraseña) {
            session()->set([
                'usuario_id' => $coordinador['ID'],
                'nombre' => $coordinador['nombre'],
                'tipo' => 'coordinador',
                'logged_in' => true
            ], $coordinador['ID']);
            return redirect()->to('/coordinador');
        }

        if ($moderador && $moderador['password'] === $contraseña) {
            session()->set([
                'usuario_id' => $moderador['ID'],
                'nombre' => $moderador['nombre'],
                'tipo' => 'coordinador',
                'logged_in' => true
            ], $moderador['ID']);
            return redirect()->to('/moderador');
        }

        return redirect()->to('/')->with('error', 'Correo o contraseña incorrectos');

    }

    public function alumno(){

        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('Alumno', [
            'nombre' => session()->get('nombre'),
            'tipo' => session()->get('tipo')
        ]);

    }

    public function maestro(){

        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('Maestro', [
            'nombre' => session()->get('nombre'),
            'tipo' => session()->get('tipo')
        ]);

    }

    public function coordinador(){

        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('Coordinador', [
            'nombre' => session()->get('nombre'),
            'tipo' => session()->get('tipo')
        ]);

    }

    public function moderador(){

        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('Moderador', [
            'nombre' => session()->get('nombre'),
            'tipo' => session()->get('tipo')
        ]);

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    //------------------------------------------------------//

///////////////////////////////////////////////////////////////////////

    //--------------- contenido dinamico -------------------//

    public function carga($pagina){

    $tabla1Model = new Tabla1Model();
    $tabla2Model = new Tabla2Model();
    $tabla3Model = new Tabla3Model();

    $escuelaModel = new EscuelaModel();
    $practica = $escuelaModel->findAll();

    $allowedPages = ['inicio', 'formulario', 'default', 'lista', 'editar', 'buscar', 'registro', 'revisar', 'papelera'];

    if (!in_array($pagina, $allowedPages)) {
        return $this->response->setStatusCode(404)->setBody('Página no encontrada');
    }

    $data = ['practica' => $practica];

    if ($pagina === 'buscar') {

        // Obtener y combinar los datos
        $todos = array_merge(
            array_map(fn($r) => $r + ['origen' => 'tabla1'], $tabla1Model->findAll()),
            array_map(fn($r) => $r + ['origen' => 'tabla2'], $tabla2Model->findAll()),
            array_map(fn($r) => $r + ['origen' => 'tabla3'], $tabla3Model->findAll())
        );

        $data['filas'] = $todos;
    }

    return view('contenido/' . $pagina, $data);
    }

    public function revision($id = null){

        if ($id === null) {
            return $this->response->setStatusCode(400)->setBody('Practica no proporcionado');
        }

        $escuelaModel = new EscuelaModel();
        $practica = $escuelaModel->find($id);

        if (!$practica) {
            return $this->response->setStatusCode(404)->setBody('Práctica no encontrada');
        }

        return view('contenido/revision', ['practica' => $practica]);

    }

    public function borracion($id = null){

        if ($id === null) {
            return $this->response->setStatusCode(400)->setBody('Practica no proporcionado');
        }

        $escuelaModel = new EscuelaModel();
        $practica = $escuelaModel->find($id);

        if (!$practica) {
            return $this->response->setStatusCode(404)->setBody('Práctica no encontrada');
        }

        return view('contenido/borracion', ['practica' => $practica]);

    }

    public function verFila($tabla, $id){

        $model = match($tabla) {
        'tabla1' => new Tabla1Model(),
        'tabla2' => new Tabla2Model(),
        'tabla3' => new Tabla3Model(),
        default  => null
    };

    if (!$model) {
        return $this->response->setStatusCode(400)->setBody('Tabla no válida');
    }

    $fila = $model->find($id);

    if (!$fila) {
        return $this->response->setStatusCode(404)->setBody('Registro no encontrado');
    }

    return view('contenido/busqueda', ['fila' => $fila, 'origen' => $tabla]);

    }

    public function fase($id = null){

        $escuelaModel = new EscuelaModel();

        $escuelaModel->update($id, [
            'Fase' => 2,
            'Fecha' => NULL
        ]);

        return $this->response->setJSON(['success' => true]);

    }

    public function papelera($id = null){

        $escuelaModel = new EscuelaModel();

        $tiempo = Time::now()->addSeconds(30)->toDateTimeString();
        
        $escuelaModel->update($id, [
            'Fase' => 0,
            'Fecha' => $tiempo
        ]);

        return $this->response->setJSON(['success' => true]);

    }

    //------------------------------------------------------//

///////////////////////////////////////////////////////////////////////

    //---------------------- CRUD Practicas ----------------//

    public function vista($id = null){

        if ($id === null) {
            return $this->response->setStatusCode(400)->setBody('Practica no proporcionado');
        }

        $escuelaModel = new EscuelaModel();
        $practica = $escuelaModel->find($id);

        if (!$practica) {
            return $this->response->setStatusCode(404)->setBody('Práctica no encontrada');
        }

        return view('contenido/lista', ['practica' => $practica]);

    }

    public function guardar(){

    $post = $this->request->getPost(['Titulo','Carrera','Estatus','Integrantes']);
    $escuelaModel = new EscuelaModel();

    $id = $escuelaModel->insert([
        'Titulo' => $post['Titulo'],
        'Carrera' => $post['Carrera'],
        'Estatus' => $post['Estatus'],
        'Integrantes' => $post['Integrantes'],
        'Fase' => 1
    ], true);

    $escuelaModel->update($id, [
        'Imagen' => $id . '-' . $post['Carrera'] .'.jpg'
    ]);

    $imagen = $this->request->getFile('imagen');
    if ($imagen && $imagen->isValid()) {
        $imagen->move(ROOTPATH . 'public/imagenes', $id . '-' . $post['Carrera'] .'.jpg', true);
    }

    return redirect()->to('/coordinador');
    }

    public function editar($id = null){

        if ($id === null) {
            return $this->response->setStatusCode(400)->setBody('ID no proporcionado');
        }

        $escuelaModel = new EscuelaModel();
        $practica = $escuelaModel->find($id);

        if (!$practica) {
            return $this->response->setStatusCode(404)->setBody('Práctica no encontrada');
        }

        return view('contenido/editar', ['practica' => $practica]);

    }

    public function actualizar($id = null){
    
    $post = $this->request->getPost(['Titulo','Carrera','Estatus','Integrantes']);
    $escuelaModel = new EscuelaModel();

    $Imagen = $escuelaModel->find($id);
    $nombreOriginal = $Imagen['Imagen'];
    
    $escuelaModel->update($id, $post);

    $nombre = $id . '-' . $post['Carrera'] . '.jpg';

    $escuelaModel->update($id, [
        'Imagen' => $nombre
    ]);

    $OldPath = FCPATH . 'imagenes/' . $nombreOriginal;
    $NewPath = FCPATH . 'imagenes/' . $nombre;

    rename($OldPath, $NewPath);

    $imagen = $this->request->getFile('imagen');
    if ($imagen && $imagen->isValid()) {
        $imagen->move(ROOTPATH . 'public/imagenes', $nombre, true);
    }

    return $this->response->setJSON(['success' => true]);

    }

    public function eliminar($id = null){

        if ($id === null) {
        return $this->response->setStatusCode(400)->setBody('ID no proporcionado');
    }

    $escuelaModel = new EscuelaModel();
    $practica = $escuelaModel->find($id);

    if (!$practica) {
        return $this->response->setStatusCode(404)->setBody('Práctica no encontrada');
    }


    $escuelaModel->delete($id);

    $imagenPath = ROOTPATH . 'public/imagenes/' . $id . '-' . $practica['Carrera'] . '.jpg';
    if (file_exists($imagenPath)) {
        unlink($imagenPath);
    }

    return $this->response->setJSON(['success' => true]);
         
    }

    //------------------------------------------------------//

//////////////////////////////////////////////////////////////////////

    //--------------------- CRUD Coordinadores ------------------//

    public function guardarC(){

        $CoordinadorModel = new CoordinadorModel();
        $post = $this->request->getPost(['nombre', 'departamento', 'correo', 'password']);
        

        $registro = $CoordinadorModel->insert([
            'nombre' => $post['nombre'],
            'departamento' => $post['departamento'],
            'correo' => $post['correo'],
            'password' => $post['password']
        ], true);
        
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid()) {
            $imagen->move(ROOTPATH . 'public/coordinadores', $registro . '-' . $post['correo'] .'.jpg', true);
        }

        return redirect()->to('/coordinador');

    }

    public function ObtenerC($id){

        $CoordinadorModel = new CoordinadorModel();
        $coordinador = $CoordinadorModel->find($id);

        if (!$coordinador) {
            return $this->response->setJSON(['error' => 'Coordinador no encontrado'])->setStatusCode(404);
        }

        return $this->response->setJSON($coordinador);

    }

    //------------------------------------------------------//

    //--------------------- CRUD moderadores ------------------//

    public function guardarMo(){

        $ModeradorModel = new ModeradorModel();
        $post = $this->request->getPost(['nombre', 'departamento', 'correo', 'password']);
        

        $registro = $ModeradorModel->insert([
            'nombre' => $post['nombre'],
            'departamento' => $post['departamento'],
            'correo' => $post['correo'],
            'password' => $post['password']
        ], true);
        
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid()) {
            $imagen->move(ROOTPATH . 'public/moderadores', $registro . '-' . $post['correo'] .'.jpg', true);
        }

        return redirect()->to('/moderador');

    }

    public function ObtenerMo($id){

        $ModeradorModel = new ModeradorModel();
        $moderador = $ModeradorModel->find($id);

        if (!$moderador) {
            return $this->response->setJSON(['error' => 'Coordinador no encontrado'])->setStatusCode(404);
        }

        return $this->response->setJSON($moderador);

    }

    //---------------------------------------------------------//
}
