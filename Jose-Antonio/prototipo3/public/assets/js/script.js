function loadContent(pagina) {
    const contentDiv = document.getElementById('content');
  
    fetch(baseUrl + '/carga/' + pagina)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar el contenido');
            }
            return response.text();
        })
        .then(data => {
            contentDiv.innerHTML = data;
        })
        .catch(error => {
            contentDiv.innerHTML = '<p>Error al cargar el contenido.</p>';
            console.error('Error:', error);
        });
  }
  
  window.onload = function () {
    loadContent('inicio');
  };
  
// ---------------------------------- buscar.php ------------------------------ //

  function verFila(tabla, id) {
    const contentDiv = document.getElementById('content');

    fetch(`${baseUrl}/verFila/${tabla}/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar la fila');
            }
            return response.text();
        })
        .then(data => {
            contentDiv.innerHTML = data;
        })
        .catch(error => {
            contentDiv.innerHTML = '<p>Error al cargar la fila.</p>';
            console.error('Error:', error);
        });
}

function filtrarFilas() {
    const input = document.getElementById("buscador");
    const filter = input.value.toLowerCase();
    const botones = document.querySelectorAll(".boton-buscador");

    botones.forEach(btn => {
        const nombre = btn.innerText.toLowerCase();
        btn.style.display = nombre.includes(filter) ? "" : "none";
    });
}

// -------------------------------------------------------------------------- //

// -------------------------- usuario.php ------------------------------ //

function mostrarModerador(){
    if (!idUsuario) {
        document.getElementById('infoUsuario').innerHTML = `<p>Error: ID de usuario no disponible.</p>`;
        document.getElementById('usuarioPanel').style.display = 'block';
        return;
    }

    fetch(`${baseUrl}obtenerMo/${idUsuario}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('infoUsuario').innerHTML = `<p>${data.error}</p>`;
            } else {
                const imgPath = `${baseUrl}moderadores/${data.ID}-${data.correo}.jpg`;
                document.getElementById('infoUsuario').innerHTML = `
                    <img src="${imgPath}" alt="Foto de perfil" width="100"><br>
                    <strong>Nombre:</strong> ${data.nombre}<br>
                    <strong>Departamento:</strong> ${data.departamento}<br>
                    <strong>Correo:</strong> ${data.correo}<br>
                `;
            }
            document.getElementById('usuarioPanel').style.display = 'block';
        })
        .catch(error => {
            console.error('Error al obtener los datos del maestro:', error);
            document.getElementById('infoUsuario').innerHTML = `<p>Error al cargar la información.</p>`;
            document.getElementById('usuarioPanel').style.display = 'block';
        });
}

function mostrarCoordinador() {
    if (!idUsuario) {
        document.getElementById('infoUsuario').innerHTML = `<p>Error: ID de usuario no disponible.</p>`;
        document.getElementById('usuarioPanel').style.display = 'block';
        return;
    }

    fetch(`${baseUrl}obtenerC/${idUsuario}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('infoUsuario').innerHTML = `<p>${data.error}</p>`;
            } else {
                const imgPath = `${baseUrl}coordinadores/${data.ID}-${data.correo}.jpg`;
                document.getElementById('infoUsuario').innerHTML = `
                    <img src="${imgPath}" alt="Foto de perfil" width="100"><br>
                    <strong>Nombre:</strong> ${data.nombre}<br>
                    <strong>Departamento:</strong> ${data.departamento}<br>
                    <strong>Correo:</strong> ${data.correo}<br>
                `;
            }
            document.getElementById('usuarioPanel').style.display = 'block';
        })
        .catch(error => {
            console.error('Error al obtener los datos del maestro:', error);
            document.getElementById('infoUsuario').innerHTML = `<p>Error al cargar la información.</p>`;
            document.getElementById('usuarioPanel').style.display = 'block';
        });
}

function cerrarPanel() {
    document.getElementById('usuarioPanel').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const btnUsuario = document.getElementById('btnUsuario');
    if (btnUsuario) {
        btnUsuario.addEventListener('click', mostrarUsuario);
    }
});

// -------------------------------------------------------------------------- //

// --------------------------- revisar.php ---------------------------------- //

function revisar(id) {
      const contentDiv = document.getElementById('content');
    
      fetch(`${baseUrl}/revision/${id}`)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error al cargar la práctica');
              }
              return response.text();
          })
          .then(data => {
              contentDiv.innerHTML = data;
          })
          .catch(error => {
              contentDiv.innerHTML = '<p>Error al cargar la práctica.</p>';
              console.error('Error:', error);
          });
  }

function fase(id) {
    fetch(`${baseUrl}/fase/${id}`, {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar la práctica');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            loadContent('inicio');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar la práctica');
    });
}

// ------------------------------------------------------------------------ //

// --------------------------- papelera.php ------------------------------- //

function papelera(id) {
    fetch(`${baseUrl}/papelera/${id}`, {
        method: 'POST'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar la práctica');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            loadContent('inicio');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar la práctica');
    });
}

function borrar(id) {
      const contentDiv = document.getElementById('content');
    
      fetch(`${baseUrl}/borracion/${id}`)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error al cargar la práctica');
              }
              return response.text();
          })
          .then(data => {
              contentDiv.innerHTML = data;
          })
          .catch(error => {
              contentDiv.innerHTML = '<p>Error al cargar la práctica.</p>';
              console.error('Error:', error);
          });
  }

// ------------------------------------------------------------------------ //

// --------------------------- CRUD PRACTICAS ----------------------------- //

  function loadPractica(id) {
      const contentDiv = document.getElementById('content');
    
      fetch(`${baseUrl}/vista/${id}`)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error al cargar la práctica');
              }
              return response.text();
          })
          .then(data => {
              contentDiv.innerHTML = data;
          })
          .catch(error => {
              contentDiv.innerHTML = '<p>Error al cargar la práctica.</p>';
              console.error('Error:', error);
          });
  }
  
  function editarPractica(id) {
      const contentDiv = document.getElementById('content');
      
      fetch(`${baseUrl}/editar/${id}`)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error al cargar el formulario de edición');
              }
              return response.text();
          })
          .then(data => {
              contentDiv.innerHTML = data;
          })
          .catch(error => {
              contentDiv.innerHTML = '<p>Error al cargar el formulario de edición.</p>';
              console.error('Error:', error);
          });
  }
  
  function actualizarPractica(event, id) {
      event.preventDefault();
      
      const form = event.target;
      const formData = new FormData(form);
      
      fetch(`${baseUrl}/actualizar/${id}`, {
          method: 'POST',
          body: formData
      })
      .then(response => {
          if (!response.ok) {
              throw new Error('Error al actualizar la práctica');
          }
          return response.json();
      })
      .then(data => {
          if (data.success) {
              loadContent('inicio');
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('Error al actualizar la práctica');
      });
  }
  
  function eliminarPractica(id) {
      if (confirm('¿Estás seguro de que deseas eliminar esta práctica?')) {
          fetch(`${baseUrl}/eliminar/${id}`, {
              method: 'DELETE'
          })
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error al eliminar la práctica');
              }
              return response.json();
          })
          .then(data => {
              if (data.success) {
                  loadContent('inicio');
              }
          })
          .catch(error => {
              console.error('Error:', error);
              alert('Error al eliminar la práctica');
          });
      }
  }
// --------------------------------------------------------------------- //