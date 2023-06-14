package com.syarifhidayat.jogstrip.Getter;

import com.google.gson.annotations.SerializedName;

public class TempatKuliners {

    @SerializedName("id_tpkuliner") private String id_tpkuliner;
    @SerializedName("id_kab") private int id_kab;
    @SerializedName("nama_tpkuliner") private String nama_tpkuliner;
    @SerializedName("fasilitas") private String fasilitas;
    @SerializedName("alamat") private String alamat;
    @SerializedName("deskripsi") private String deskripsi;
    @SerializedName("jam_buka") private String jam_buka;
    @SerializedName("jam_tutup") private String jam_tutup;
    @SerializedName("gambar") private String gambar;
    @SerializedName("latitude") private Float latitude;
    @SerializedName("longitude") private Float longitude;


    public String getId_tpkuliner() {
        return id_tpkuliner;
    }

    public int getId_kab() {
        return id_kab;
    }

    public String getNama_tpkuliner() {
        return nama_tpkuliner;
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

    public String getJam_buka() {
        return jam_buka;
    }

    public String getJam_tutup() {
        return jam_tutup;
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
