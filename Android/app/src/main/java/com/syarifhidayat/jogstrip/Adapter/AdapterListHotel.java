package com.syarifhidayat.jogstrip.Adapter;

import android.content.Context;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Filter;
import android.widget.Filterable;
import android.widget.ImageView;
import android.widget.TextView;
import com.bumptech.glide.Glide;
import com.syarifhidayat.jogstrip.Activity.DeskripsiHotel;
import com.syarifhidayat.jogstrip.Activity.Home;
import com.syarifhidayat.jogstrip.ApiClient;
import com.syarifhidayat.jogstrip.Getter.Hotels;
import com.syarifhidayat.jogstrip.R;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;

//import com.syarifhidayat.jogjatravel.MapFragmentHotel;

public class AdapterListHotel extends RecyclerView.Adapter<AdapterListHotel.Holder> implements Filterable {
    private Context context;
    private List<Hotels> listHotels;
    double jarakKeHotel;
    List<Hotels> filterList;


    public AdapterListHotel(Context context, List<Hotels> hotels) {
        this.context = context;
        this.listHotels = hotels;
        filterList = listHotels;
    }

    @NonNull
    @Override
    public Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.layout_list_hotel,parent,false);
        Holder holder = new Holder(view);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull final Holder holder, final int position) {

        holder.tv_namaHotel.setText(listHotels.get(position).getNama_hotel());
        holder.tv_alamatHotel.setText(listHotels.get(position).getAlamat());
        holder.tv_listhargaHotel.setText("Rp. " + FormatAngka(listHotels.get(position).getHarga()));
        double lat = listHotels.get(position).getLatitude();
        double longt = listHotels.get(position).getLongitude();
        holder.tv_listjarakHotel.setText("± "+ new DecimalFormat("##.##").format(hitungJarak(lat, longt)) + " KM");

        Glide.with(context).load(ApiClient.IMAGEHOTEL_URL + listHotels.get(position)
                .getGambar()).error(R.mipmap.ic_launcher).into(holder.imgHotel);

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent i = new Intent(context, DeskripsiHotel.class);

                i.putExtra("namaHotel", listHotels.get(position).getNama_hotel());
                i.putExtra("idHotel", listHotels.get(position).getId_hotel());
                //openMapFragment();
                i.putExtra("alamatHotel", listHotels.get(position).getAlamat());
                i.putExtra("gambarHotel", listHotels.get(position).getGambar());
                i.putExtra("deskripsiHotel", listHotels.get(position).getDeskripsi());
                i.putExtra("fasilitasHotel", listHotels.get(position).getFasilitas());
                i.putExtra("hargaHotel", listHotels.get(position).getHarga());
                i.putExtra("latHotel", listHotels.get(position).getLatitude());
                i.putExtra("lngHotel", listHotels.get(position).getLongitude());

                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                context.startActivity(i);


            }
        });
    }

    public String FormatAngka(int angka) {
        NumberFormat nf = new DecimalFormat("#,##0");
        return nf.format(angka);
    }

    @Override
    public int getItemCount() {
        return listHotels.size();
    }


    public class Holder extends RecyclerView.ViewHolder {
        private ImageView imgHotel;
        private TextView tv_namaHotel, tv_alamatHotel, tv_listhargaHotel, tv_listjarakHotel;

        public Holder(View itemView) {
            super(itemView);

            imgHotel = itemView.findViewById(R.id.imgHotel);
            tv_namaHotel = itemView.findViewById(R.id.tv_namaHotel);
            tv_alamatHotel = itemView.findViewById(R.id.tv_alamatHotel);
            tv_listhargaHotel = itemView.findViewById(R.id.tv_listhargaHotel);
            tv_listjarakHotel = itemView.findViewById(R.id.tv_listjarakHotelll);

            //hitungJarak()
        }
    }

    @Override
    public Filter getFilter() {

        return new Filter() {
            @Override
            protected FilterResults performFiltering(CharSequence constraint) {
                String charString = constraint.toString();
                if(charString.isEmpty())
                {
                    listHotels = filterList;
                }
                else
                {
                    List<Hotels> mListHotel = new ArrayList<>();
                    for (Hotels data : filterList)
                    {
                        if(data.getNama_hotel().toLowerCase().contains(charString))
                        {
                            mListHotel.add(data);
                        }
                    }
                    listHotels = mListHotel;
                }
                FilterResults filterResults = new FilterResults();
                filterResults.values = listHotels;
                return filterResults;
            }

            @Override
            protected void publishResults(CharSequence constraint, FilterResults results) {
                listHotels = (List<Hotels>) results.values;
                notifyDataSetChanged();
            }
        };
    }

    //Fungsi perhitungan menghitung jarak
    public static double distFrom(
            double lat1, double lng1, double lat2, double lng2)
    {
       /* double dist;
        Location locationCurrent = new Location("");
        locationCurrent.setLatitude(lat1);
        locationCurrent.setLongitude(lng1);

        Location locationB = new Location("");
        locationB.setLatitude(lat2);
        locationB.setLongitude(lng2);
        dist = locationCurrent.distanceTo(locationB) / 1000;
        dist = (double) (Math.round(dist * 100)) / 100;
        return dist;
       */
        double dbRadiusMeters = 6378137 ; // Earth’s mean radius in meter
        double dbLatitudeDiff = Math.toRadians(lat2 - lat1);
        double dbLongitudeDiff = Math.toRadians(lng2 - lng1);

        double a = Math.sin(dbLatitudeDiff / 2) * Math.sin(dbLatitudeDiff / 2) +
                Math.cos(Math.toRadians(lat1)) * Math.cos(Math.toRadians(lat2)) *
                        Math.sin(dbLongitudeDiff / 2) * Math.sin(dbLongitudeDiff / 2);

        double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        double d = dbRadiusMeters * c /1000;
        return d;
    }

    //Fungsi menampilkan jarak ke hotel
    private double hitungJarak(double latitude, double longitude){
        //jarakKeHotel = distFrom(Home.selfLat, Home.selfLng, saveLatHotel, saveLngHotel);
        jarakKeHotel = distFrom(Home.selfLat, Home.selfLng, latitude, longitude);
        Log.d("jarak", String.valueOf(jarakKeHotel));
        return jarakKeHotel;
    }

}


