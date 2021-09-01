# Installation and Configuration

1. Open command prompt or bash terminal.
1. Go to the directory where the repository is being stored/cloned by using 
   the "cd" command.
   
   example: 
   ```
   cd /var/www
   cd C:\xampp\htdocs
   ```
        
2. Clone this repository using "git clone <URL> <folder_name>" command
   
   example: 
   ``` 
   git clone https://github.com/lowildlr10/dostcarportal.git dostcarportal
   ```
   
3. Navigate inside the cloned repository by using "cd" command
   
   example:
   ```
   cd dostcarportal
   ```
        
4. Run this command "cp .env.examples .env" (Linux or MAC) or 
   "copy .env.examples .env" or simply duplicate ".env.examples"
   then rename it to ".env".
  
5. Open .env file by using the text editor or the terminal text 
   editors (vim, nano, and etc.), then edit this fields APP_NAME,
   APP_DEBUG, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and 
   DB_PASSWORD
    
    example:
    ```
    APP_NAME="DOST-CAR Portal"
    APP_DEBUG=false
    
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dostcarportal
    DB_USERNAME=dostcarportal
    DB_PASSWORD=dostcarportal
    ```
       
 6. Then run this following commands:
 
    ```
    "composer install"
    "php artisan key:generate"
    "php artisan migrate:refresh --seed"
    "php artisan cache:clear"
    "php artisan config:clear"
    "php artisan view:clear"
    ```
      
 7. Access the site then login this admin credentials:
 
    ```
    Username: admin
    Password: admin
    ```
