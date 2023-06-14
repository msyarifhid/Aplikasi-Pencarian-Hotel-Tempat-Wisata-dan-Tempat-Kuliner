package com.syarifhidayat.jogstrip.Adapter;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.PorterDuff;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import com.syarifhidayat.jogstrip.Activity.DeskripsiHotel;
import com.syarifhidayat.jogstrip.Activity.DeskripsiTpKuliner;
import com.syarifhidayat.jogstrip.Activity.DeskripsiTpWisata;
import com.syarifhidayat.jogstrip.BasePlace;
import com.syarifhidayat.jogstrip.R;

import java.text.DecimalFormat;
import java.util.List;

public class AdapterTerdekatTpKuliner extends RecyclerView.Adapter<AdapterTerdekatTpKuliner.ViewwHolder> {

    Context context;
    List<BasePlace> listBasePlace;

    public AdapterTerdekatTpKuliner(Context context, List<BasePlace> listBasePlace) {
        this.context = context;
        this.listBasePlace = listBasePlace;
    }

    @NonNull
    @Override
    public ViewwHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        return new ViewwHolder(LayoutInflater.from(context).inflate(R.layout.layout_item_terdekat_tpkuliner, parent, false));

    }

    @Override
    public void onBindViewHolder(@NonNull ViewwHolder holder, int position) {


        com.syarifhidayat.jogstrip.BasePlace bP = listBasePlace.get(position);
        holder.tv_jarakTerdekatTpKuliner.setText(new DecimalFormat("#.##").format(bP.getJarakTerdekat())+ " KM");
        holder.tv_tempatTerdekatTpKuliner.setText(bP.getNamaTerdekat());

        if (bP.getJenis().equals("hotel")){
            holder.icTerdekatTpKuliner.setColorFilter(Color.RED, PorterDuff.Mode.SRC_ATOP);
        }else if(bP.getJenis().equals("tempat_wisata")){
            holder.icTerdekatTpKuliner.setColorFilter(Color.GREEN, PorterDuff.Mode.SRC_ATOP);
        }else if(bP.getJenis().equals("tempat_kuliner")){
            holder.icTerdekatTpKuliner.setColorFilter(Color.YELLOW, PorterDuff.Mode.SRC_ATOP);
        }

        //click to deskripsiTerdekat
        holder.ly_itemTerdekatTpKuliner.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //Toast.makeText(context, "KLIK TEMPAT TERDEKAT >", Toast.LENGTH_LONG).show();

                if (bP.getJenis().equals("hotel")){
                    Intent intentTerdekat = new Intent(context, DeskripsiHotel.class);
                    //namaHotelTerdekat = bP.getNamaTerdekat();
                    //Toast.makeText(context, namaHotelTerdekat, Toast.LENGTH_LONG).show();
                    intentTerdekat.putExtra("namaHotel", bP.getNamaTerdekat());
                    intentTerdekat.putExtra("alamatHotel", bP.getAlamat());
                    intentTerdekat.putExtra("gambarHotel", bP.getGambar());
                    intentTerdekat.putExtra("deskripsiHotel", bP.getDeskripsi());
                    intentTerdekat.putExtra("latHotel", bP.getLatitude());
                    intentTerdekat.putExtra("lngHotel", bP.getLongitude());

                    intentTerdekat.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(intentTerdekat);

                }else if(bP.getJenis().equals("tempat_wisata")){
                    Intent intentTerdekat = new Intent(context, DeskripsiTpWisata.class);

                    intentTerdekat.putExtra("namaTpWisata", bP.getNamaTerdekat());
                    intentTerdekat.putExtra("alamatTpWisata", bP.getAlamat());
                    intentTerdekat.putExtra("gambarTpWisata", bP.getGambar());
                    intentTerdekat.putExtra("deskripsiTpWisata", bP.getDeskripsi());
                    intentTerdekat.putExtra("latTpWisata", bP.getLatitude());
                    intentTerdekat.putExtra("lngTpWisata", bP.getLongitude());

                    intentTerdekat.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(intentTerdekat);

                }else if(bP.getJenis().equals("tempat_kuliner")){
                    Intent intentTerdekat = new Intent(context, DeskripsiTpKuliner.class);

                    intentTerdekat.putExtra("namaTpKuliner", bP.getNamaTerdekat());
                    intentTerdekat.putExtra("alamatTpKuliner", bP.getAlamat());
                    intentTerdekat.putExtra("gambarTpKuliner", bP.getGambar());
                    intentTerdekat.putExtra("deskripsiTpKuliner", bP.getDeskripsi());
                    intentTerdekat.putExtra("latTpKuliner", bP.getLatitude());
                    intentTerdekat.putExtra("lngTpKuliner", bP.getLongitude());

                    intentTerdekat.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(intentTerdekat);
                }
            }
        });
    }

    @Override
    public int getItemCount() {
        return listBasePlace.size();
    }

    static class ViewwHolder extends RecyclerView.ViewHolder{

        ImageView icTerdekatTpKuliner;
        TextView tv_tempatTerdekatTpKuliner, tv_jarakTerdekatTpKuliner;
        LinearLayout ly_itemTerdekatTpKuliner;

        public ViewwHolder(View itemView) {
            super(itemView);

            icTerdekatTpKuliner = itemView.findViewById(R.id.icTerdekatTpKuliner);
            tv_tempatTerdekatTpKuliner = itemView.findViewById(R.id.tv_tempatTerdekatTpKuliner);
            tv_jarakTerdekatTpKuliner = itemView.findViewById(R.id.tv_jarakTerdekatTpKuliner);
            ly_itemTerdekatTpKuliner = itemView.findViewById(R.id.ly_itemTerdekatTpKuliner);
        }
    }
}
