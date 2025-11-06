<?php
namespace Models;

use DateTime;

class Bodega {
    private ?int $id_bodega;
    private string $nombre;
    private string $localizacion;
    private ?string $telefono;
    private ?string $email;
    private ?string $contacto;
    private ?string $descripcion;
    private bool $tieneRestaurante;
    private bool $tieneHotel;
    private DateTime $fechaFundacion;
    private ?array $vinos;

    public function __construct(
        ?int $id_bodega,
        string $nombre,
        string $localizacion,
        ?string $telefono,
        ?string $email,
        ?string $contacto,
        ?string $descripcion,
        bool $tieneRestaurante,
        bool $tieneHotel,
        DateTime $fechaFundacion,
        ?array $vinos = null
    ) {
        $this->id_bodega = $id_bodega;
        $this->nombre = $nombre;
        $this->localizacion = $localizacion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contacto = $contacto;
        $this->descripcion = $descripcion;
        $this->tieneRestaurante = $tieneRestaurante;
        $this->tieneHotel = $tieneHotel;
        $this->fechaFundacion = $fechaFundacion;
        $this->vinos = $vinos;
    }

    public function getIdBodega(): int {
        return $this->id_bodega;
    }

    public function setIdBodega(int $id_bodega): void {
        $this->id_bodega = $id_bodega;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getLocalizacion(): string {
        return $this->localizacion;
    }

    public function setLocalizacion(string $localizacion): void {
        $this->localizacion = $localizacion;
    }

    public function getTelefono(): ?string {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): void {
        $this->telefono = $telefono;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getContacto(): ?string {
        return $this->contacto;
    }

    public function setContacto(?string $contacto): void {
        $this->contacto = $contacto;
    }

    public function getDescripcion(): ?string {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function tieneRestaurante(): bool {
        return $this->tieneRestaurante;
    }

    public function setTieneRestaurante(bool $tieneRestaurante): void {
        $this->tieneRestaurante = $tieneRestaurante;
    }

    public function tieneHotel(): bool {
        return $this->tieneHotel;
    }

    public function setTieneHotel(bool $tieneHotel): void {
        $this->tieneHotel = $tieneHotel;
    }

    public function getFechaFundacion(): DateTime {
        return $this->fechaFundacion;
    }

    public function setFechaFundacion(DateTime $fechaFundacion): void {
        $this->fechaFundacion = $fechaFundacion;
    }
     public function getVinos(): ?array {
        return $this->vinos;
    }

    public function setVinos(?array $vinos): void {
        $this->vinos = $vinos;
    }

    public function addVino(Vino $vino): void {
        if ($this->vinos === null) {
            $this->vinos = [];
        }
        $this->vinos[] = $vino;
    }

}


?>