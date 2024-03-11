<?php
use Illuminate\Http\Request;

//guardar imagenes
function guardarImagen(Request $request)
{
    // Validar que se haya subido una imagen
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Obtener el archivo de la solicitud
    $imagen = $request->file('foto');

    // Generar un nombre único para la imagen
    $nombreImagen = time() . '_' . $request->nombre;

    // Almacenar la imagen en la carpeta 'public/img/usuarios'
    $imagen->storeAs('img/usuarios', $nombreImagen, 'public');

    // Aquí puedes guardar el nombre de la imagen en la base de datos si es necesario
    //return back()->with('success', 'La imagen ha sido cargada exitosamente.');
    echo 'aquiii';
}
 ?>
