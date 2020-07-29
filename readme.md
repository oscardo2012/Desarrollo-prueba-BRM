# # Desarrollo-prueba
Desarrollo de la prueba técnica de desarrollador back para BRM.  
Realizado por Oscar Fernando Espinosa Rocha.
***
## Descripción de la solución:

##### 1. Back-end
El desarrollo del back-end se desarrollo utilizando el framework Laravel en su versión 7.22.4.  
Consiste en un API Rest para ser consumido por el cliente del API.  
- En el archivo `config/database.php` se deben configurar los parámetros para realizar la conexión con la base de datos.
    - Los parámetros de conexión que se deben modificar son el usuario y la clave de MySql.  

Se debe abrir una ventana de terminal, cmd, etc. y ubicarse en la carpeta del proyecto.
- Se deben realizar las siguientes configuraciones:
    ```sh
    % composer dump-autoload
    % php artisan config:cache
    % php artisan key:generate
    ```
-   Para levantar el servidor se debe ejecutar
    ```sh
    % php artisan serve
    ```
- Por defecto Laravel se ejecuta en la dirección: 
    [http://localhost:8000/](http://localhost:8000/)  
- Los métodos del API se acceden a través de [http://localhost:8000/api/](http://localhost:8000/api/)
##### 2. Front-end
Para el desarrollo del cliente del API:
-   Se usaron:  
    * La librería `jQuery`.  
    * La biblioteca `Bootstrap`.  
    * La plantilla `INSPINIA - Responsive Admin Theme`.  
- Se recomienda desplegarlo en un servidor web.
- También se puede desplegar en un servidor temporal usando `PHP` de la siguiente forma:  
    * En la terminal, cmd, etc. ubicarse en la carpeta del cliente del API.
    * Ejecutar la siguiente instrucción:
        ```sh
        % php -S=localhost:12345
        ```
    * Así el cliente se ejecutará en `http://localhost:12345/`
-   La URL del API se debe modificar en el archivo `js/funciones.js`, en la línea 1, en la variable `URL_API`

##### 3. Base de datos
La base de datos se hizo usando MySql.
- En la carpeta `Base de datos` se encuentra el archivo `Base de datos.sql` que contiene la estructura y los datos para poder hacer uso del sistema.
    * Este archivo fue generado con MySql Workbench.


##### 4. Nota
Se pueden presentar problemas de comunicación entre el cliente web y el API por cuestiones de CORS.  
Se recomienda instalar en el navegador algún plug-in que permita las peticiones CORS.  
- Firefox: [CORS Everywhere](https://addons.mozilla.org/es/firefox/addon/cors-everywhere/)  
- Chrome: [Allow CORS: Access-Control-Allow-Origin](https://chrome.google.com/webstore/detail/allow-cors-access-control/lhobafahddgcelffkeicbaginigeejlf)