package com.QueenslandBrainMap_QUT.heritage_places;

import com.thoughtworks.xstream.annotations.XStreamAlias;
import com.thoughtworks.xstream.annotations.XStreamOmitField;

/**
 * Created by lukebusstra on 4/07/15.
 */
@XStreamAlias("place")
public class Place {

    @XStreamAlias("place_ref")
    private int place_ref;

    @XStreamAlias("name")
    private String name;

    @XStreamAlias("description")
    private String description;


    @XStreamAlias("street_address")
    private String address;

    @XStreamAlias("suburb")
    private String suburb;

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }


    public String getAddress() {
        return address;
    }

    public String getSuburb() {
        return suburb;
    }



}