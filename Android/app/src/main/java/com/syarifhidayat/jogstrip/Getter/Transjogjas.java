package com.syarifhidayat.jogstrip.Getter;

import com.google.gson.annotations.SerializedName;

public class Transjogjas {

    @SerializedName("id_hotel") private int id_hotel;
    @SerializedName("id_kab") private int id_kab;
    @SerializedName("nama_hotel") private String nama_hotel;
    @SerializedName("fasilitas") private String fasilitas;
    @SerializedName("alamat") private String alamat;
    @SerializedName("deskripsi") private String deskripsi;
    @SerializedName("gambar") private String gambar;
    @SerializedName("latitude") private Float latitude;
    @SerializedName("longitude") private Float longitude;

    public int getId_hotel() {
        return id_hotel;
    }

    public int getId_kab() {
        return id_kab;
    }

    public String getNama_hotel() {
        return nama_hotel;
    }

    public String getFasilitas() {
        return fasilitas;
    }

    public String getAlamat() {
        return alamat;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public String getGambar() {
        return gambar;
    }

    public Float getLatitude() {
        return latitude;
    }

    public Float getLongitude() {
        return longitude;
    }
}
