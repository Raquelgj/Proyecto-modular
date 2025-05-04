<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Aquí puedes guardar los datos en la base de datos o enviar un correo
        // Por ahora, solo redirigimos con un mensaje de éxito
        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado con éxito');
    }
}
