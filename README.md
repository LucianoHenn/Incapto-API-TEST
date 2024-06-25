# API de Control de Robot

Este proyecto es una API desarrollada en Laravel para controlar el movimiento de un robot en una cuadrícula de 10x10. El robot puede moverse en las direcciones Norte, Sur, Este y Oeste y responde a comandos específicos para girar y moverse.

## Requisitos

- PHP >= 7.3
- Composer
- Laravel 8.x

## Instalación

1. Clona el repositorio:  
   git clone https://github.com/tu-usuario/Incapto-API-TEST.git
   cd Incapto-API-TEST

2. Instala las dependencias  
   composer install

3. Iniciar el servidor  
    php artisan serve

## Descripción del Endpoint

### Mover al Robot

#### URL
POST /api/robot/move

Parámetros

	•	commands (string, requerido): Una cadena de caracteres que representa los comandos de movimiento. Los comandos válidos son:
	•	L para girar a la izquierda.
	•	R para girar a la derecha.
	•	M para mover el robot una casilla en la dirección actual.

Ejemplo de Input

{
  "commands": "LMMMRMMRRMMML"
}

Ejemplo de Output

{
  "position": "2:3:W"
}

El endpoint devuelve la posición final y la dirección del robot en el formato x:y:dirección.

#### Validación

La API valida que el campo commands:

	•	Sea una cadena de texto.
	•	Contenga solo los caracteres L, R o M.
	•	En caso de error, devuelve un mensaje indicando las posiciones de los caracteres inválidos.

{"message":"Validation error","status":false,"errors":{"commands":["The commands field contains invalid characters at positions: 3, 4."]}}

## Estructura del Proyecto

	•	app/Http/Controllers/RobotController.php: Controlador principal que maneja las solicitudes API.
	•	app/Services/RobotService.php: Servicio que contiene la lógica de movimiento y simplificación de comandos del robot.
	•	app/Rules/ValidCommands.php: Regla de validación personalizada para los comandos.


## Docker

### 🧱 Crear imagen
```bash
docker build -t incapto/rest-api -f Dockerfile .
```

### ⌨️ Levantar entorno de desarrollo
```bash
docker run -it -w/app -v$(pwd):/app -p8080:8080 incapto/rest-api php -S 0.0.0.0:8080 -t /app/public
# Open http://127.0.0.1:8080 in your browser
```
=======
>>>>>>> c30e7efe6b46bdc3ef79f8088a7a415b08592d40
