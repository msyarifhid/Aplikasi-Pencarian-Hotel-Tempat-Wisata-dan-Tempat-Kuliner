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
import com.syarifhidayat.jogstrip.Activity.DeskripsiTpKuliner;
import com.syarifhidayat.jogstrip.Activity.Home;
import com.syarifhidayat.jogstrip.ApiClient;
import com.syarifhidayat.jogstrip.Getter.TempatKuliners;
import com.syarifhidayat.jogstrip.R;

import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.List;

//import com.syarifhidayat.jogjatravel.MapFragmentTpKuliner;

public class AdapterListTpKuliner extends RecyclerView.Adapter<AdapterListTpKuliner.Holder> implements Filterable {
    private Context context;
    private List<TempatKuliners> listTpKuliners;
    List<TempatKuliners> filterList;

    double jarakKeKuliner;
    /*TextView tvlistjarakKuliner;*/

    public AdapterListTpKuliner(Context context, List<TempatKuliners> restorans) {
        this.context = context;
        this.listTpKuliners = restorans;
        filterList = listTpKuliners;
    }

    @NonNull
    @Override
    public Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.layout_list_tpkuliner,parent,false);
        Holder holder = new Holder(view);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull final Holder holder, final int position) {

        holder.tv_namaTpKuliner.setText(listTpKuliners.get(position).getNama_tpkuliner());
        holder.tv_alamatTpKuliner.setText(listTpKuliners.get(position).getAlamat());
        double lat = listTpKuliners.get(position).getLatitude();
        double longt = listTpKuliners.get(position).getLongitude();
        holder.tv_listjarakKuliner.setText("± "+ new DecimalFormat("##.##").format(hitungJarak(lat, longt)) + " KM");

        Glide.with(context).load(ApiClient.IMAGEKULINER_URL + listTpKuliners.get(position)
                .getGambar()).error(R.mipmap.ic_launcher).into(holder.imgTpKuliner);

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent i = new Intent(context, DeskripsiTpKuliner.class);


                i.putExtra("idTpKuliner", listTpKuliners.get(position).getId_tpkuliner());
                i.putExtra("namaTpKuliner", listTpKuliners.get(position).getNama_tpkuliner());
                //openMapFragment();
                i.putExtra("alamatTpKuliner", listTpKuliners.get(position).getAlamat());
                i.putExtra("gambarTpKuliner", listTpKuliners.get(position).getGambar());
                i.putExtra("deskripsiTpKuliner", listTpKuliners.get(position).getDeskripsi());
                i.putExtra("latTpKuliner", listTpKuliners.get(position).getLatitude());
                i.putExtra("lngTpKuliner", listTpKuliners.get(position).getLongitude());

                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                context.startActivity(i);

            }
        });
    }

    @Override
    public int getItemCount() {
        return listTpKuliners.size();
    }


    public class Holder extends RecyclerView.ViewHolder {
        private ImageView imgTpKuliner;
        private TextView tv_namaTpKuliner, tv_alamatTpKuliner, tv_listjarakKuliner;

        public Holder(View itemView) {
            super(itemView);

            imgTpKuliner = itemView.findViewById(R.id.imgTpKuliner);
            tv_namaTpKuliner = itemView.findViewById(R.id.tv_namaTpKuliner);
            tv_alamatTpKuliner = itemView.findViewById(R.id.tv_alamatTpKuliner);
            tv_listjarakKuliner = itemView.findViewById(R.id.tv_listjarakKulinerrr);

            //hitungJarak();
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
                    listTpKuliners = filterList;
                }
                else
                {
                    List<TempatKuliners> mListTpKuliner = new ArrayList<>();
                    for (TempatKuliners data : filterList)
                    {
                        if(data.getNama_tpkuliner().toLowerCase().contains(charString))
                        {
                            mListTpKuliner.add(data);
                        }
                    }
                    listTpKuliners = mListTpKuliner;
                }
                FilterResults filterResults = new FilterResults();
                filterResults.values = listTpKuliners;
                return filterResults;
            }

            @Override
            protected void publishResults(CharSequence constraint, FilterResults results) {
                listTpKuliners = (List<TempatKuliners>) results.values;
                notifyDataSetChanged();
            }
        };
    }

    //Fungsi perhitungan menghitung jarak
    public static double distFrom(
            double lat1, double lng1, double lat2, double lng2)
    {
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
        jarakKeKuliner = distFrom(Home.selfLat, Home.selfLng, latitude, longitude);
        Log.d("jarak", String.valueOf(jarakKeKuliner));
        return jarakKeKuliner;
    }

}
