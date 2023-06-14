package com.syarifhidayat.jogstrip;

import com.google.gson.annotations.SerializedName;

public class BasePlace {

    @SerializedName("id")   String id;
    @SerializedName("nama")  String namaTerdekat;
    @SerializedName("jarak") Double jarakTerdekat;
    @SerializedName("jenis") String jenis;

    @SerializedName("gambar") String gambar;
    @SerializedName("alamat") String alamat;
    @SerializedName("deskripsi") String deskripsi;

    @SerializedName("latitude") Float latitude;
    @SerializedName("longitude") Float longitude;

    public String getId() {
        return id;
    }

    public String getJenis() {
        return jenis;
    }

    public String getNamaTerdekat() {
        return namaTerdekat;
    }

    public void setNamaTerdekat(String namaTerdekat) {
        this.namaTerdekat = namaTerdekat;
    }

    public Double getJarakTerdekat() {
        return jarakTerdekat;
    }

    public void setJarakTerdekat(Double jarakTerdekat) {
        this.jarakTerdekat = jarakTerdekat;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public String getGambar() {
        return gambar;
    }

    public String getAlamat() {
        return alamat;
    }

    public Float getLatitude() {
        return latitude;
    }

    public Float getLongitude() {
        return longitude;
    }
}
