# Git desde consola

Listados de comandos más uitlizados en git desde consola.

## Generales 

    // Listar la configuración
    $ git config --list

    // Configurar el usuario
    $ git config --global user.name "Mariano Del Rosso"
    $ git config --global user.email mdelrosso@gmail.com

    // Ayuda
    $ git help
    
## Crear repositorios

    // Inicializar un repositorio con git
    $ git init
    
      
## Add, Commits

    // Agregar archivos del stagging area
    $ git add <file(s)>
    
    // Remover archivos del stagging area
    $ git remove <file(s)>
    
    // Commit changes
    $ git commit -m "Mensaje del commit"

## View and logs

    // Ver el estado actual del repositorio (Muy usado)
    $ git status

    // Grafico de commits
    git log --pretty=format:"%h %s" --graph
    
    // Grafico de commits con limite
    git log --pretty=format:"%h %s" --graph -<n>

    

## Merge y Branch

    // Crear una rama
    $ git branch <nombreRama>
    
    // Cambiar a una rama
    $ git checkout <nombreRama>
    
    // Fusionar ramas
    
    



