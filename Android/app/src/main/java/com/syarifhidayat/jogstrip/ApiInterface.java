package com.syarifhidayat.jogstrip;

import com.syarifhidayat.jogstrip.Getter.*;
import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

import java.util.List;

public interface ApiInterface {

    @GET("getHotel.php")
    Call<List<Hotels>> getHotels(
            //@Query("item_type") String item_type,
            @Query("key") String keyword

    );

    @GET("getDetailKamarHotel.php")
    Call<List<DetailKamarHotel>> getDetailKamarHotel(
            //@Query("item_type") String item_type,
            @Query("key") int keyword

    );

    @GET("getTempatKuliner.php")
    Call<List<TempatKuliners>> getTpKuliners(
            //@Query("item_type") String item_type,
            @Query("key") String keyword
    );

    @GET("getDetailTempatKuliner.php")
    Call<List<DetailTempatKuliners>> getDetailTpKuliners(
            //@Query("item_type") String item_type,
            @Query("key") String keyword
    );

    @GET("getTempatWisata.php")
    Call<List<TempatWisatas>> getTpWisatas(
            //@Query("item_type") String item_type,
            @Query("key") String keyword
    );

    @GET("getAllTempatTerdekat.php")
    Call<List<BasePlace>> getAllTempatTerdekat(
            @Query("jenis") String jenis,
            @Query("lat") float latitude,
            @Query("lng") float longitude
    );

    @GET("getAllTempatTerdekat.php")
    Call<List<BasePlace>> getAllTempatTerdekatTransjogja(
            @Query("jenis") String jenis,
            @Query("lat") float latitude,
            @Query("lng") float longitude
    );
}
