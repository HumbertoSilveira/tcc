# Modelo de projetos

Este modelo visa organizar e agilizar o desenvolvimento de novos projetos, pois, possui
muitas funcionalidades, comuns a vários projetos, já prontas e com testes realizados, agilizando assim
o processo de desenvolvimento. O modelo possui integração com o 
template [adminLTE](https://adminlte.io/themes/AdminLTE/index2.html) no back-end
e no front-end possui uma estrutura pronta para desenvolver um site, caso seja necessário.

>Observação:
><br/>
>Para a criação deste modelo foi utilizada a versão **5.5.40** do [Laravel](https://laravel.com/docs/5.5)



## Conteúdo do projeto:
- Área administrativa possui os seguintes módulos:
    - Ferramenta para limpar todo o cache
    - Cadastro de configurações
    - Cadastro de módulos
    - Cadastro de perfis de usuário
    - Cadastro de permissões de perfil
    - Cadastro de usuários
    - Ferramenta para simular o login com outro usuário
    - Ferramenta para visualizar e/ou limpar o log do laravel
    - Área para alteração de dados do usuário sem ligação com o 
    módulo de cadastro de usuários
    
- Estrututa para desenvolvimento de site opcional
    - Contém uma página de exemplo utilizando o template padrão do blade

## Intruções de instalação:
1. Clone o projeto
2. Comentar as linhas de permissao de usuarios no arquivo authServiceProvider.php

        ...
        $permissoes = Permissao::with('perfis')->get();
        foreach($permissoes as $permissao){
            $gate->define($permissao->slug, function(User $usuario) use($permissao){
                return $usuario->hasPermission($permissao);
            });
        }
    
        $gate->before(function(User$usuario){
            if($usuario->hasAnyRole('root'))
                return true;
        });
        ...
3. Renomeie o arquivo .env.example para .env
4. Configure o arquivo .env com as credenciais do banco de dados
    
        DB_DATABASE=[nomedobanco]
        DB_USERNAME=[usuariodobanco]
        DB_PASSWORD=[senhadobanco]
    
4. Rode composer install
5. Rode php artisan make:template
6. Descomentar as linhas de permissao de usuarios no arquivo authServiceProvider.php do item 2.

## Instruções para deploy em hospedagem compartilhada (kinghost)

1. Habilitar o ssh no painel

    <img src="https://king.host/wiki/wp-content/uploads/2016/09/ativar-ssh.png"/>

2. Acessar o FTP pelo SSH (utilizando Cmder ou terminal) com o comando:
        
        ssh usuario-ftp@host-ftp
        
3. Instalar o composer na pasta de nível acima da pasta pública com o comando:

        curl -sS https://getcomposer.org/installer | php

4. Crie uma pasta com o nome do projeto um nível acima da pasta pública
5. Fazer upload de todas as pastas do projeto com exceção da pasta vendor e node_modules caso exista, para a pasta criada.
6. Instale as dependencias do composer
        
        php composer.phar install
        
7. Rode o seguinte comando dentro da pasta pública para criar um link simbólico.

        "ln -s ~/<pastadoprojeto>/public public"
        
8. Dentro da pasta pública crie ou adicione o seguinte conteúdo ao arquivo .htaccess:
        
        RewriteCond %{HTTP_HOST} ^(nomedoprojeto\.com\.br)(:80)? [NC]
        RewriteRule ^(.*) https://www.nomedoprojeto.com.br/$1 [R=301,L]
        
        
        RewriteCond %{HTTP_HOST} ^www\.nomedoprojeto\.com\.br [NC]
        RewriteCond %{SERVER_PORT} 80
        RewriteRule ^(.*)$ https://www.nomedoprojeto.com.br/$1 [R,L]
        
        RewriteEngine On
        RewriteCond %{REQUEST_URI} !^public
        RewriteRule ^(.*)$ public/$1 [L]