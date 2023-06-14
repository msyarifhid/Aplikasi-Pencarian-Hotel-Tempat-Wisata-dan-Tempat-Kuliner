package com.syarifhidayat.jogstrip.Adapter;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import com.bumptech.glide.Glide;
import com.syarifhidayat.jogstrip.ApiClient;
import com.syarifhidayat.jogstrip.Getter.DetailTempatKuliners;
import com.syarifhidayat.jogstrip.R;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.List;

public class AdapterDetailTempatKuliner extends RecyclerView.Adapter<AdapterDetailTempatKuliner.Holder> {
    private Context context;
    private List<DetailTempatKuliners> listDetailTempatKuliner;

    public AdapterDetailTempatKuliner(Context context, List<DetailTempatKuliners> listDetailTempatKuliner) {
        this.context = context;
        this.listDetailTempatKuliner = listDetailTempatKuliner;
    }

    @NonNull
    @Override
    public Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.layout_item_mk_kuliner,parent,false);
        Holder holder = new Holder(view);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull AdapterDetailTempatKuliner.Holder holder, int position) {

        holder.tv_nama_mkKuliner.setText(listDetailTempatKuliner.get(position).getNama());
        holder.tv_listharga_mkKuliner.setText("Rp. " + FormatAngka(listDetailTempatKuliner.get(position).getHarga()));

        Glide.with(context).load(ApiClient.IMAGEMKKULINER_URL + listDetailTempatKuliner.get(position)
                .getGambar()).error(R.mipmap.ic_launcher).into(holder.img_mkKuliner);

        /*Log.i("ccc", listDetailTempatKuliner.get(position).getNama());*/
       /* if (bP.getJenis().equals("hotel")){
            holder.icTerdekatTpKuliner.setColorFilter(Color.RED, PorterDuff.Mode.SRC_ATOP);
        }else if(bP.getJenis().equals("tempat_wisata")){
            holder.icTerdekatTpKuliner.setColorFilter(Color.GREEN, PorterDuff.Mode.SRC_ATOP);
        }else if(bP.getJenis().equals("tempat_kuliner")){
            holder.icTerdekatTpKuliner.setColorFilter(Color.YELLOW, PorterDuff.Mode.SRC_ATOP);
        }
*/
    }

    public String FormatAngka(int angka) {
        NumberFormat nf = new DecimalFormat("#,##0");
        return nf.format(angka);
    }

    @Override
    public int getItemCount() {
        return listDetailTempatKuliner.size();
    }

    public class Holder extends RecyclerView.ViewHolder {
        private ImageView img_mkKuliner;
        private TextView tv_nama_mkKuliner, tv_listharga_mkKuliner;

        public Holder(View itemView) {
            super(itemView);

            img_mkKuliner = itemView.findViewById(R.id.img_mkKuliner);
            tv_nama_mkKuliner = itemView.findViewById(R.id.tv_nama_mkKuliner);
            tv_listharga_mkKuliner = itemView.findViewById(R.id.tv_listharga_mkKuliner);

            //hitungJarak()
        }
    }
}