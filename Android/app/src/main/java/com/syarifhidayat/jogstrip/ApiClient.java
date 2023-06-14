package com.syarifhidayat.jogstrip;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ApiClient {
//    public static final String BASE_URL = "http://192.168.43.196/jogja_easytrip/api/";
//    public static final String IMAGEHOTEL_URL = "http://192.168.43.196/jogja_easytrip/uploaded/hotel/";
//    public static final String IMAGEKULINER_URL = "http://192.168.43.196/jogja_easytrip/uploaded/tpkuliner/";
//    public static final String IMAGEWISATA_URL = "http://192.168.43.196/jogja_easytrip/uploaded/wisata/";

    public static final String BASE_URL = "https://jogstripmshid.000webhostapp.com/api/";
    public static final String IMAGEHOTEL_URL = "https://jogstripmshid.000webhostapp.com/uploaded/hotel/";
    public static final String IMAGEKULINER_URL = "https://jogstripmshid.000webhostapp.com/uploaded/tpkuliner/";
    public static final String IMAGEWISATA_URL = "https://jogstripmshid.000webhostapp.com/uploaded/wisata/";
    public static final String IMAGEMKKULINER_URL = "https://jogstripmshid.000webhostapp.com/uploaded/mnkuliner/";
    public static final String IMAKMHOTEL_URL = "https://jogstripmshid.000webhostapp.com/uploaded/kmhotel/";

    public static Retrofit retrofit;

    public static Retrofit getApiClient(){

        if (retrofit == null){
            Gson gson = new GsonBuilder()
                    .setLenient()
                    .create();
            retrofit = new Retrofit.Builder()
                    .baseUrl(BASE_URL)
                    .addConverterFactory(GsonConverterFactory.create(gson))
                    .build();
        }
        return  retrofit;
    }

}
