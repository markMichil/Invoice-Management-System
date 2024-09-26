
## About Invoice Management System
-   
- Admin Panel:
  - Login/logout
  - List customer
  - List/add action log book
  - Crud invoice
  - Mail with update
  
- API application:
  -    
      -FEATURES : 
- USER ROLES : ADMIN AND EMPOLYEE
- Customers : name , email , phone ,has_invoices
- INVOICES : CRUD OPERATION + Delivery Status
- TRACK MAIL : with Update Delivery status
- ACTION LOG : FOR USERS (create , update ,delete)
- DELETE : USING SOFT Delete 
- Install Application follow this instruction

  - composer install
    - php artisan key:generate
  - update database info at env file
    - php artisan migrate --seed
  - check user seeder for email and password 
  
- update env file mail test
  - 
          MAIL_MAILER=smtp
          MAIL_HOST=sandbox.smtp.mailtrap.io
          MAIL_PORT=2525
          MAIL_USERNAME=fcd3d3671ba7d3
          MAIL_PASSWORD=1907f202b349cc
          MAIL_FROM_NAME="DOMAIN NAME"

## GITHUB
- environments [local and production] 
- key url and token for test local and after merge test production using the keys 
- example url : "http://127.0.0.1:8000/api"
- example token : "3|aILVY7bNedMdHDscmh2kQcX6R4naSWqo9ca7TnHY3aa38b4d"
- [GitHub Collection ](https://www.postman.com/crimson-shuttle-1921/invoice-management/overview).


