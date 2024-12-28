<?php

class Libro{
    
    private $id; 
    private $titulo;
    private $autor; 
    private $genero;
    private $estado; 
    
    
    public function __construct($idParam, $tituloParam, $autorParam, $generoParam, $estadoParam = "Disponible"){
        
        $this->id = $idParam;
        $this->titulo = $tituloParam;
        $this->autor = $autorParam;
        $this->genero = $generoParam;
        $this->estado = $estadoParam;
    }
    
public function obtenerTitulo(){
    return $this->titulo;
}

public function obtenerAutor(){
    return $this->autor;
}

public function obtenerEstado(){
    return $this->estado;
}

public function obtenerGenero(){
    return $this->genero;
}

 public function cambiarEstado($nuevoEstado) {
        $this->estado = $nuevoEstado;
    }
}


class Biblioteca {
    private $libros = [];

    public function agregarLibro(Libro $libro) {
        $this->libros[] = $libro;
    }

    public function buscarLibroPorTitulo($titulo) {
        foreach ($this->libros as $libro) {
            if (strcasecmp($libro->obtenerTitulo(), $titulo) === 0) {
                return $libro;
            }
        }
        return null;
    }

    public function buscarLibrosPorAutor($autor) {
        $resultados = [];
        foreach ($this->libros as $libro) {
            if (strcasecmp($libro->obtenerAutor(), $autor) === 0) {
                $resultados[] = $libro;
            }
        }
        return $resultados;
    }

    public function buscarLibrosPorGenero($genero) {
        $resultados = [];
        foreach ($this->libros as $libro) {
            if (strcasecmp($libro->obtenerGenero(), $genero) === 0) {
                $resultados[] = $libro;
            }
        }
        return $resultados;
    }

    public function prestarLibro($titulo) {
        $libro = $this->buscarLibroPorTitulo($titulo);
        if ($libro && $libro->obtenerEstado() === 'Disponible') {
            $libro->cambiarEstado('Prestado');
            return "El libro '$titulo' ha sido prestado exitosamente.\n\n";
        } elseif ($libro) {
            return "El libro '$titulo' no está disponible.\n\n";
        } else {
            return "El libro '$titulo' no se encontró en la biblioteca.\n\n";
        }
    }

    public function mostrarLibros() {
        foreach ($this->libros as $libro) {
            echo "Título: " . $libro->obtenerTitulo() . "\n";
            echo "Autor: " . $libro->obtenerAutor() . "\n";
            echo "Categoría: " . $libro->obtenerGenero() . "\n";
            echo "Estado: " . $libro->obtenerEstado() . "\n\n";
        }
    }
}


$biblioteca = new Biblioteca();
$libro1 = new Libro(1, "El Resplandor", "Stephen King", "Terror Piscologico");
$libro2 = new Libro(2, "Cien Años de Soledad", "Gabriel García Márquez", "Novela");
$libro3 = new Libro(3, "Los Pájaros", "Alfred Hitchcocks", "Suspenso");

$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);
$biblioteca->agregarLibro($libro3);

echo $biblioteca->prestarLibro("Los Pájaros");
$biblioteca->mostrarLibros();



?>