package com.QueenslandBrainMap_QUT.Community_service;

import com.googlecode.jcsv.reader.CSVEntryParser;

/**
 * Created by lukebusstra on 5/07/15.
 */
public class CommunityEntryParser implements CSVEntryParser<Community_service>{
    public Community_service parseEntry(String[] data){
        String name = data[7];
        Double latitude = Double.parseDouble(data[11]);
        Double longitude = Double.parseDouble(data[12]);

        return new Community_service(name, latitude, longitude);
    }
}
