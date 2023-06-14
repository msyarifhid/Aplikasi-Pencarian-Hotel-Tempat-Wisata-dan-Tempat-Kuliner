package com.syarifhidayat.jogstrip.Getter;

import com.google.gson.annotations.SerializedName;

public class DetailKamarHotel {
    @SerializedName("gamkamar") private String gamkamar;

    public String getGambar() {
        return gamkamar;
    }
}
