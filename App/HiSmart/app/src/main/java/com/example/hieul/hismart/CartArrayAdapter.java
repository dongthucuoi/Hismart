package com.example.hieul.hismart;

import android.content.Context;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.List;

/**
 * Created by hieul on 29-Oct-17.
 */

public class CartArrayAdapter extends ArrayAdapter<CartGetSetListView> {
    private int resource;
    private LayoutInflater inflater;
    private Context context;

    public CartArrayAdapter(Context ctx, int resourceId, List<CartGetSetListView> objects) {
        super(ctx, resourceId, objects);
        resource = resourceId;
        inflater = LayoutInflater.from(ctx);
        context = ctx;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        convertView = (LinearLayout) inflater.inflate(resource, null);
        CartGetSetListView cart = getItem(position);

        ImageView imgMon = (ImageView) convertView.findViewById(R.id.imgMon);
        TextView tenMon = (TextView) convertView.findViewById(R.id.tenMon);
        tenMon.setText(cart.getTenmon());

        ImageButton imgDel = (ImageButton) convertView.findViewById(R.id.Del);
        TextView gia = (TextView) convertView.findViewById(R.id.giaMon);
        gia.setText(cart.getGia());


        String uri = "drawable/" + cart.getImgmon();
        String uri1 = "drawable/" + cart.getImgdel();

        int imageResource = context.getResources().getIdentifier(uri, null, context.getPackageName());
        Drawable image = context.getResources().getDrawable(imageResource);
        imgMon.setImageDrawable(image);

        int imageResource1 = context.getResources().getIdentifier(uri1, null, context.getPackageName());
        Drawable image1 = context.getResources().getDrawable(imageResource1);
        imgDel.setImageDrawable(image1);


        return convertView;
    }
}

