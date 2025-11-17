<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso a la Plataforma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Definición del color Azul Neón */
        .text-neon-blue { color: #00FFFF; } /* Cyan / Aqua */
        .bg-neon-blue { background-color: #00FFFF; }
        .border-neon-blue { border-color: #00FFFF; }
        
        /* Tema Oscuro y estilos generales */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0F172A; /* Slate 900 */
        }

        /* Degradado animado para el fondo */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-bg {
            background: linear-gradient(-45deg, #0F172A, #0B111D, #001f3f, #0F172A);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        /* Estilo de la tarjeta de login */
        .login-card {
            backdrop-filter: blur(10px);
            background-color: rgba(23, 29, 46, 0.8); /* Dark Card semi-transparente */
            border: 1px solid rgba(0, 255, 255, 0.3); /* Borde Azul Neón sutil */
        }
    </style>
</head>
<body class="animated-bg text-gray-100">
    <div class="min-h-screen flex justify-center items-center p-4">
        <div class="login-card rounded-2xl shadow-2xl p-8 sm:p-10 w-full max-w-sm transform transition duration-500 hover:scale-[1.01]">
            
            <header class="mb-6 text-center">
                <!-- Icono temático con efecto neón -->
                <i class="fas fa-satellite-dish text-6xl text-neon-blue mb-4 opacity-80" style="filter: drop-shadow(0 0 5px #00FFFF);"></i>
                <h2 class="text-3xl font-bold text-neon-blue mb-2" style="text-shadow: 0 0 5px rgba(0, 255, 255, 0.5);">
                    Acceso al Sistema
                </h2>
                <p class="text-gray-400 font-medium">¡Bienvenido! Entra a tu portal académico:</p>
            </header>
            
            @if(session('error'))
                <div class="p-3 mb-4 text-sm font-medium rounded-lg bg-red-900 text-red-300 border border-red-700/50">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mt-8">
                <p class="text-center text-gray-300 mb-4 font-semibold">
                    acceder a tu cuenta:
                </p>

                <!-- Botón de Google (Estilo Standard de la mayoría) -->
                <a href="{{ route('social.login', 'google') }}" 
                   class="w-full flex items-center justify-center px-6 py-3 text-lg font-semibold rounded-xl 
                          bg-white text-gray-700 border border-gray-300 shadow-md 
                          hover:bg-gray-100 transition duration-200 
                          focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <i class="fab fa-google text-2xl mr-4 text-gray-700"></i> 
                    Acceder con Google
                </a>
            </div>

            <footer class="text-center mt-6 pt-4 border-t border-gray-700/50">
                <small class="text-gray-500">
                    <i class="fas fa-lock mr-1"></i> Autenticación gestionada por Laravel Socialite.
                </small>
            </footer>

        </div>
    </div>
</body>
</html>