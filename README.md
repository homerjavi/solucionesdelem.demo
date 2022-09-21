# Soluciones Delem
## Instalación:
1. **git clone https://github.com/homerjavi/solucionesdelem.demo.git**
2. En la consola accedemos a la carpeta del proyecto
3. **composer install**
4. **cp .env.example .env**
5. Crear base de datos: 
    - Nombre: delem
    - Usuario: root
    - Contraseña: 
6. **php artisan migrate:fresh --seed**
7. **php artisan key:generate**
8. **php artisan storage:link**

En este punto ya tenemos todo instalado, ya solo nos queda iniciar el servicio de base de datos y "levantar" el proyecto con **php artisan serve**

## Apreciaciones
- Como me comentaste que utilizabais Livewire, quise implementarlo en la prueba. Es una herramienta que que probé hace tiempo y no supe sacarle demasiado partido, pero la verdad que es súper interesante, e imagino que aprendiéndola correctamente y dedicándole tiempo será brutal!

- Me hubiera gustado realizar alguna validación adicional al grabar un mensaje del chat, como la de comprobar que el chat_id pertenezca al usuario que está enviando el mensaje o al creador del servicio asociado a ese chat, pero desde Livewire cambia un poco esto y no tuve más tiempo para investigar :(

- Hay seeders que crean dos usuarios y algunos servicios. Los usuarios son:
    - juan@juan.com   - password
    - laura@laura.com - password

- Respecto al chat, implementé "Pusher" para que se actualizasen en tiempo real los mensajes del chat, pero me he quedado un poco "preocupado" con el tema de las notificaciones de pusher, y la posterior renderización del componente que muestra los mensajes, me explico... Cada vez que hay un nuevo mensaje pusher notifica a la aplicación y se renderiza de nuevo la vista recuperando los mensajes de la base de datos. El "problema" es que se renderiza en todos los chats, aunque no sean del usuario al que va dirigido el mensaje. Intenté hacerlo con un método que analizase el nuevo mensaje que llegaba y solo actualizase los chats que correspondiesen, pero creo que al recibir el evento, el componente se renderizaba de nuevo automáticamente, aunque no cumpliese con la comprobación que realizaba. Finalmente, viendo que no se filtraba, el evento llama al método "render". 

### Cualquier duda me decís. Gracias!
