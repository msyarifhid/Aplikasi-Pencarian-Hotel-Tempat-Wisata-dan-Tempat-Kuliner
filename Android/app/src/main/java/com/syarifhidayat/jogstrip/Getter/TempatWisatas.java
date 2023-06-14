package com.syarifhidayat.jogstrip.Getter;

import com.google.gson.annotations.SerializedName;

public class TempatWisatas {

    @SerializedName("id_tpwisata") private int id_tpwisata;
    @SerializedName("id_kab") private int id_kab;
    @SerializedName("nama_tpwisata") private String nama_tpwisata;
    @SerializedName("harga_tiket") private int harga_tiket;
    @SerializedName("alamat") private String alamat;
    @SerializedName("deskripsi") private String deskripsi;
    @SerializedName("gambar") private String gambar;
    @SerializedName("latitude") private Float latitude;
    @SerializedName("longitude") private Float longitude;

    public int getId_tpwisata() {
        return id_tpwisata;
    }

    public int getId_kab() {
        return id_kab;
    }

    public String getNama_tpwisata() {
        return nama_tpwisata;
    }

    public int getHarga_tiket() {
        return harga_tiket;
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
