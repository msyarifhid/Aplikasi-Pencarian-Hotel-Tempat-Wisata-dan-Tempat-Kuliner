package com.syarifhidayat.jogstrip.Getter;

import com.google.gson.annotations.SerializedName;

public class DetailTempatKuliners {
    @SerializedName("nama") private String  nama;
    @SerializedName("gambar") private String gambar;
    @SerializedName("harga") private int harga;



    public String getNama() {
        return nama;
    }

    public String getGambar() {
        return gambar;
    }

    public int getHarga() {
        return harga;
    }
}
