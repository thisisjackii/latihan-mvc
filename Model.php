<?php

class Model
{
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'latihan_mvc');
    }

    function read()
    {
        $stmt = $this->conn->query("SELECT * FROM mahasiswa");
        $results = $stmt->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $this->conn->close();
        return $results;
    }

    function insert($nim, $nama, $angkatan, $prodi, $kelas)
    {
        $stmt = $this->conn->prepare("INSERT INTO mahasiswa (nim, nama, angkatan, prodi, kelas) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issss", $nim, $nama, $angkatan, $prodi, $kelas);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

    function update($nim_baru, $nim_lama, $nama, $angkatan, $prodi, $kelas)
    {
        $stmt = $this->conn->prepare("UPDATE mahasiswa SET nim =?, nama =?, angkatan =?, prodi =?, kelas =? WHERE nim =?");
        $stmt->bind_param("issssi", $nim_baru, $nama, $angkatan, $prodi, $kelas, $nim_lama);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

    function delete($nim)
    {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE nim =?");
        $stmt->bind_param("i", $nim);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
}
