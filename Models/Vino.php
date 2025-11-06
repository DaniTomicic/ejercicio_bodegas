<?php 
namespace Models;
class Vino {
    private ?int $id_vino;
    private ?string $nombre;
    private ?string $descripcion;
    private ?int $anio;
    private ?float $alcohol;
    private ?string $tipo;
    private ?Bodega $bodega;

    public function __construct(
        ?int $id_vino = null,
        ?string $nombre= null,
        ?string $descripcion = null,
        ?int $anio = null,
        ?float $alcohol = null,
        ?string $tipo = null,
        ?Bodega $bodega = null
    ) {
        $this->id_vino = $id_vino;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->anio = $anio;
        $this->alcohol = $alcohol;
        $this->tipo = $tipo;
        $this->bodega = $bodega;
    }

    // Getters
    public function getIdVino(): int {
        return $this->id_vino;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getDescripcion(): ?string {
        return $this->descripcion;
    }

    public function getAnio(): ?int {
        return $this->anio;
    }

    public function getAlcohol(): ?float {
        return $this->alcohol;
    }

    public function getTipo(): ?string {
        return $this->tipo;
    }

    public function getBodega(): ?Bodega {
        return $this->bodega;
    }

    // Setters
    public function setIdVino(int $id_vino): void {
        $this->id_vino = $id_vino;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setDescripcion(?string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setAnio(?int $anio): void {
        $this->anio = $anio;
    }

    public function setAlcohol(?float $alcohol): void {
        $this->alcohol = $alcohol;
    }

    public function setTipo(?string $tipo): void {
        $this->tipo = $tipo;
    }

    public function setBodega(?Bodega $bodega): void {
        $this->bodega = $bodega;
    }
}

?>