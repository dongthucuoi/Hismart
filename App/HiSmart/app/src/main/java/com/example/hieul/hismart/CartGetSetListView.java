package com.example.hieul.hismart;

/**
 * Created by hieul on 29-Oct-17.
 */

public class CartGetSetListView {
    public CartGetSetListView(String imgMon, String tenmon, String gia, String imgDel) {
        super();
        this.imgmon = imgMon;
        this.tenmon = tenmon;
        this.gia = gia;
        this.imgdel = imgDel;


    }

    private String imgmon;
    private String tenmon;
    private String gia;
    private String imgdel;

    public String getImgmon() {
        return imgmon;
    }
    public void setImgmon(String imgmon) {
        this.imgmon = imgmon;
    }

    public String getTenmon() {
        return tenmon;
    }

    public void setTenmon(String tenmon) {
        this.tenmon = tenmon;
    }

    public String getGia() {
        return gia;
    }

    public void setGia(String gia) {
        this.gia = gia;
    }

    public String getImgdel() {
        return imgdel;
    }

    public void setImgdel(String imgdel) {
        this.imgdel = imgdel;
    }
}
