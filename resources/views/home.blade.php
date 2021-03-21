<!DOCTYPE html>
<html lang="pt/br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel com Bootstrap</title>

    <link rel="stylesheet" href="{{asset('site/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.container-fluid {
    width: 100vw;
    height: 100vh;
    background: #000;
    overflow: hidden;
}

.title {
    font-size: 60px;
    text-align: center;
    user-select: none;
    color: #c9c9c9;
}

.inputbox {
    position: relative;
    display: flex;
    flex-direction: column-reverse;
    height: 40px;
    margin: 10px;
}

.inputbox label {
    position: relative;
    top:0;
    left: 20px;
    font-size: 20px;
    color: #556566;
    transition: .5s;
    cursor: text;
}

.inputbox input {
    position: absolute;
    background-image: linear-gradient(145deg, #faa61f 0%,#faa61f 0%, #ed1847 100%);
    width: 100%;
    height: 3px;
    bottom: 0;
    box-shadow: none;
    border: none;
    outline: none;
    border-radius: 2px;
    transition: .5s;
    font-size: 20px;
    font-weight: bold;
    padding: 0 10px;
}

.inputbox input:focus,
.inputbox input:valid {
    height: 100%;
}

.inputbox input:focus + label,
.inputbox input:valid + label {
    top: -40px;
    left: 0;
}

button {
    position: relative;
    display: inline-block;
    width: 20vw;
    padding: 15px 30px;
    background-image: radial-gradient(circle, #d1816b, #d58270, #da8375, #de847a, #e2857f, #e77d83, #ea758a, #eb6d93, #e55ca7, #d453c0, #b155de, #6d5ffb);
    color: #190919;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 0.95em;
    font-weight: 700;
    letter-spacing: 2px;
    border-radius: 8px;
    border: 1px solid #c9c9c9;
}

button:hover {
    transition-delay: 0.5s;
    color: #f9f9f9;
    box-shadow: 0 0 10px #ea758a,
    0 0 10px #ff2562,
    0 0 20px #ea758a,
    0 0 40px #ff2562,
    0 0 80px #ea758a;
}

</style>
<body>
    <div class="container-fluid">
        <form method="POST" action="{{route('form.formsubmit')}}">
            @csrf
            <h1 class="title d-flex justify-content-center pt-5">Preencha seus Dados</h1>
            <h4 class=" d-flex justify-content-center pb-5">Para finalizar o seu pedido</h4>
            <div class="row pb-5">
                <div class="col inputbox">
                    <input type="text" id="nome" name="nome" required>
                    <label for="nome">Nome</label>
                </div>
                <div class="col inputbox">
                    <input type="text" id="email"name="email" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col inputbox">
                    <input type="text" id="cep" name="cep" required>
                    <label for="cep">CEP</label>
                </div>
                <div class="col inputbox">
                    <input type="text" id="address" name="endereco" maxlength='0'  required>
                    <label for="address">Endereço</label>
                </div>
                <div class="col inputbox">
                    <input type="text" id="numero" name="numero" maxlength='10' required>
                    <label for="numero">Número</label>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col inputbox">
                    <input type="text" id="neighborhood" name="bairro" maxlength='0' required>
                    <label for="neighborhood">Bairro</label>
                </div>
                <div class="col inputbox">
                    <input type="text" id="city" name="cidade" maxlength='0' required>
                    <label for="city">Cidade</label>
                </div>
                <div class="col inputbox">
                    <input type="text" id="state" name="estado" maxlength='0' required>
                    <label for="state">Estado</label>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button>Finalizar compra</button>
            </div>
        </form>

    </div>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script>
        const cleanForm = (address) =>{
            document.getElementById('address').value = '';
            document.getElementById('neighborhood').value = '';
            document.getElementById('city').value = '';
            document.getElementById('state').value = '';
        }

        const fillForm = (address) => {
            document.getElementById('address').value = address.logradouro;
            document.getElementById('neighborhood').value = address.bairro;
            document.getElementById('city').value = address.localidade;
            document.getElementById('state').value = address.uf;
        }

        const valNumber = (num) => /^[0-9]+$/.test(num);

        const cepVal = (cep) => cep.length == 8 && valNumber(cep);

        const searchCep = async() => {
            cleanForm();

            const cep = document.getElementById('cep').value;
            const url = `http://viacep.com.br/ws/${cep}/json/`;
            if (cepVal(cep)){
                const data = await fetch(url);
                const address = await data.json();
                if (address.hasOwnProperty('erro')){
                    document.getElementById('address').value = 'CEP NÂO ENCONTRADO';
                } else {
                    fillForm(address);
                }
            } else {
                document.getElementById('address').value = 'CEP INCORRETO'
            }
        }

        document.getElementById('cep')
                .addEventListener('focusout', searchCep);
    </script>
</body>
</html>
