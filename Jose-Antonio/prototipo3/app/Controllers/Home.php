<?php

namespace App\Controllers;

use App\Models\EscuelaModel;
use App\Models\AlumnoModel;
use App\Models\MaestroModel;
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

        $correo = $this->request->getPost('correo');
        $contraseña = $this->request->getPost('password');

        $alumno = $alumnoModel->where('correo', $correo)->first();
        $maestro = $maestroModel->where('correo', $correo)->first();

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

    $allowedPages = ['inicio', 'formulario', 'default', 'lista', 'editar', 'buscar', 'registro', 'revisar'];

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

    $imagen = $this->request->getFile('imagen');
    if ($imagen && $imagen->isValid()) {
        $imagen->move(ROOTPATH . 'public/imagenes', $id . '-' . $post['Carrera'] .'.jpg', true);
    }

    return redirect()->to('/maestro');
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
    
    $escuelaModel->update($id, $post);

    $imagen = $this->request->getFile('imagen');
    if ($imagen && $imagen->isValid()) {
        $imagen->move(ROOTPATH . 'public/imagenes', $id . '-' . $post['Carrera'] .'.jpg', true);
    }

    return $this->response->setJSON(['success' => true]);

    }

    public function fase($id = null){

        $escuelaModel = new EscuelaModel();

        $escuelaModel->update($id, [
            'Fase' => 2
        ]);

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

    //--------------------- CRUD Maestros ------------------//

    public function guardarM(){

        $MaestroModel = new MaestroModel();
        $post = $this->request->getPost(['nombre', 'departamento', 'correo', 'password']);
        

        $registro = $MaestroModel->insert([
            'nombre' => $post['nombre'],
            'departamento' => $post['departamento'],
            'correo' => $post['correo'],
            'password' => $post['password']
        ], true);
        
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid()) {
            $imagen->move(ROOTPATH . 'public/maestros', $registro . '-' . $post['departamento'] .'.jpg', true);
        }

        return redirect()->to('/maestro');

    }

    public function ObtenerM($id){

        $MaestroModel = new MaestroModel();
        $maestro = $MaestroModel->find($id);

        if (!$maestro) {
            return $this->response->setJSON(['error' => 'Maestro no encontrado'])->setStatusCode(404);
        }

        return $this->response->setJSON($maestro);

    }

    //------------------------------------------------------//
}
