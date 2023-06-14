package com.syarifhidayat.jogstrip;

import com.google.gson.annotations.SerializedName;

public class BasePlaceTransjogja {

    @SerializedName("id")   int id;
    @SerializedName("nama")  String namaTerdekat;
    @SerializedName("jarak") Double jarakTerdekat;
    @SerializedName("jenis") String jenis;

    @SerializedName("alamat") String alamat;

    @SerializedName("latitude") Float latitude;
    @SerializedName("longitude") Float longitude;

    public int getId() {
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
