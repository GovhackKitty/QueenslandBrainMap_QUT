package com.QueenslandBrainMap_QUT;

import com.javaroots.latlong.AddressConverter;
import com.javaroots.latlong.GoogleResponse;
import com.javaroots.latlong.Result;

import java.sql.PreparedStatement;
import java.sql.SQLException;

/**
 * Created by lukebusstra on 4/07/15.
 */
public class Data {

    private Category category_name;
    private int id;
    private Sub_Category sub_category;
    private String name;
    private String description;
    private double latitude;
    private double longitude;

    /**
     * Constructor for data without a longitude or latitude
     * @param category_name
     * @param id
     * @param sub_category
     * @param name
     * @param description
     * @param address
     * @param suburb
     */
    public Data(Category category_name, int id, Sub_Category sub_category, String name, String description,
                String address, String suburb) throws Exception {
        AddressToLatLong("" + address + " " + suburb);
        this.category_name = category_name;
        this.id = id;
        this.sub_category = sub_category;
        this.name = name;
        this.description = description;
    }

    /**
     * Constructor for data with longitude and latitude
     * @param category_name
     * @param id
     * @param sub_category
     * @param name
     * @param description
     * @param latitude
     * @param longitude
     */
    public Data(Category category_name, int id, Sub_Category sub_category, String name, String description,
                double latitude, double longitude) {
        this.category_name = category_name;
        this.id = id;
        this.sub_category = sub_category;
        this.name = name;
        this.description = description;
        this.latitude = latitude;
        this.longitude = longitude;
    }

    /**
     * Turns an address into a Longitude and latitude throught com.javaroots.latlong
     * @param address
     * @throws Exception
     */
    private void AddressToLatLong(String address) throws Exception {
            GoogleResponse res = new AddressConverter().convertToLatLong(address);
            if (res.getStatus().equals("OK")) {
                for (Result result : res.getResults()) {
                    this.longitude = Double.parseDouble(result.getGeometry().getLocation().getLng());
                    this.latitude = Double.parseDouble(result.getGeometry().getLocation().getLat());
                }
            } else {
                System.out.println(res.getStatus());
            }

    }

    /**
     * Getter
     * @return
     */
    public String getCategory_name() {
        return category_name.toString();
    }

    /**
     * Getter
     * @return
     */
    public int getId() {
        return id;
    }

    /**
     * Getter
     */
    public String getSub_category() {
        return sub_category.toString();
    }

    /**
     * Getter
     * @return
     */
    public String getName() {
        return name;
    }

    /**
     * Getter
     * @return
     */
    public String getDescription() {
        return description;
    }

    /**
     * Getter
     * @return
     */
    public double getLatitude() {
        return latitude;
    }

    /**
     * Getter
     * @return
     */
    public double getLongitude() {
        return longitude;
    }

    /**
     * Connects to database
     * @param connection
     * @throws SQLException
     */
    public void ToDatabase(JDBCConnection connection) throws SQLException{
        connection.InsertToDatabase(this, 0);
        }
}
