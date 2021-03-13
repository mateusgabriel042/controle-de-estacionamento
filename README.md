# Back-end API - Controle de estacionamento

Projeto de um pequeno sistema de controle de estacionamento

## 1. Tecnologias utilizada

	- PHP 8.0.
	- Laravel 8.
	- JWTAuth (para autenticação).
	- Spatie (para controle de acesso).

## 2. Instalação da API

### 2.1. Executar Migrations

utilize o comando no artisan:

	- php artisan migrate

### 2.2. Executar Seeders

utilize os comandos no artisan:

	- php artisan db:seed --class=PermissionsSeeder
	- php artisan db:seed --class=PricePermanenceVehiclesSeeder
	- php artisan db:seed --class=VehiclesSeeder

#### 2.2.1

	o primeiro Seeder criará as funções, permissões e o registro de 2 usuários (Admin e Collaborator):

	{
	    "users": [
	        {
	            "id": 1,
	            "name": "admin",
	            "email": "admin@example.com",
	            "email_verified_at": "2021-03-12T19:58:49.000000Z",
	            "created_at": "2021-03-12T19:58:49.000000Z",
	            "updated_at": "2021-03-12T19:58:49.000000Z"
	        },
	        {
	            "id": 2,
	            "name": "collaborator",
	            "email": "collaborator@example.com",
	            "email_verified_at": "2021-03-12T19:58:50.000000Z",
	            "created_at": "2021-03-12T19:58:50.000000Z",
	            "updated_at": "2021-03-12T19:58:50.000000Z"
	        }
	    ]
	}

	o segundo Seeder criará um preço de permanencia do veiculo (apenas para teste):

	{
	    "permanences": [
	        {
	            "id": 1,
	            "ppv_type_vehicle": "car",
	            "ppv_qtd_hours": 1,
	            "ppv_price": "5.00"
	        }
	    ]
	}

	o terseiro Seeder criará dois veiculos (apenas para teste):

	{
	    "vehicles": [
	        {
	            "id": 1,
	            "veh_plate": "654jfx",
	            "veh_model": "Onix plus",
	            "veh_brand": "Chevrolet",
	            "veh_color": "White",
	            "veh_price_permanence": "5.00",
	            "veh_hour_enter": "2021-03-12 20:00:23",
	            "veh_hour_out": null,
	            "id_price_permanence_vehiculo": 1
	        },
	        {
	            "id": 2,
	            "veh_plate": "342liv",
	            "veh_model": "Uno",
	            "veh_brand": "FIAT",
	            "veh_color": "White",
	            "veh_price_permanence": "5.00",
	            "veh_hour_enter": "2021-03-12 20:00:23",
	            "veh_hour_out": null,
	            "id_price_permanence_vehiculo": 1
	        }
	    ]
	}

### 2.3. Rotas

#### 2.3.1 Rotas de autenticação

	Rota de registro

	POST	|	/api/auth/register

	{
		"name": admin,
		"email": admin@example.com,
		"password": abcd1234,
		"password_confirmation": abcd1234,
	}

	Rota de login

	POST	|	/api/auth/login
	header 	|	Authorization: Bearer __token

	Token gerado após o login

	{
	    "access_token": <token>,
	    "token_type": "bearer",
	    "expires_in": 3600
	    "user": <User>
	}


#### 2.3.2 Rotas da Model PermanenceVehicles

	Rota INDEX (list registers)

	GET	| api/price-permanence-vehicles

	
	Rota CREATE

	POST	|	api/price-permanence-vehicles

	{
        "ppv_type_vehicle": "car",
        "ppv_qtd_hours": 1,
        "ppv_price": 5.00,
    }


	Rota SHOW

	GET	|	api/price-permanence-vehicles/{idPermanence}


	Rota UPDATE

	PUT	|	api/price-permanence-vehicles/{idPermanence}

	{
        "ppv_type_vehicle": "bus",
        "ppv_qtd_hours": 1,
        "ppv_price": 7.50,
    }


    Rota DELETE

	DELETE	|	api/price-permanence-vehicles/{idPermanence}

#### 2.3.3 Rotas da Model Vehicles

	Rota INDEX (list registers)

	GET	| api/vehicles

	
	Rota CREATE

	POST	|	api/vehicles

	{
        "veh_plate": "654jfx",
        "veh_model": "Onix plus",
        "veh_brand": "Chevrolet",
        "veh_color": "White",
        "id_price_permanence_vehiculo": 1
    }


	Rota SHOW

	GET	|	api/vehicles/{idVehicle}


	Rota UPDATE

	PUT	|	api/vehicles/{idVehicle}

	{
        "veh_plate": "897ghh",
        "veh_model": "Uno",
        "veh_brand": "Fiat",
        "veh_price_permanence": 15.00,
        "veh_color": "black",
        "id_price_permanence_vehiculo": 1
    }


    Rota DELETE

	DELETE	|	api/vehicles/{idVehicle}


	ROTA END_PERMANENCE

	PUT	 |	api/vehicles/end-permanence/{idVehicle}

#### 2.3.3 Rotas da Model User

	Rota INDEX (list registers)

	GET	| api/users


	Rota SHOW

	GET	|	api/users/{idUser}


	Rota DELETE

	DELETE	|	api/users/{idUser}