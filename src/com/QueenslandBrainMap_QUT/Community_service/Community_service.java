package com.QueenslandBrainMap_QUT.Community_service;

import com.QueenslandBrainMap_QUT.Category;
import com.QueenslandBrainMap_QUT.Sub_Category;
import com.googlecode.jcsv.annotations.MapToColumn;

/**
 * Created by lukebusstra on 5/07/15.
 */

public class Community_service {

    //@MapToColumn(column = 7)
    private String name;

    private static Category category = Category.SERVICES;

    private static Sub_Category sub_category = Sub_Category.FACILITIES;

    //@MapToColumn(column = 11)
    private double latitude;

    //@MapToColumn(column = 12)
    private double longitude;

    public String getName() {
        return name;
    }

    public static String getCategory() {
        return category.toString();
    }

    public static String getSub_category() {
        return sub_category.toString();
    }

    public double getLatitude() {
        return latitude;
    }

    public double getLongitude() {
        return longitude;
    }

    public Community_service(String name, double latitude, double longitude) {
        this.name = name;
        this.latitude = latitude;
        this.longitude = longitude;
    }
}
