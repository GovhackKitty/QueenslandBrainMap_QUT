package com.QueenslandBrainMap_QUT;
import com.QueenslandBrainMap_QUT.Community_service.Community_service;
import com.QueenslandBrainMap_QUT.heritage_places.heritage_places;
import com.QueenslandBrainMap_QUT.Community_service.CommunityEntryParser;
import com.QueenslandBrainMap_QUT.heritage_places.Place;
import com.javaroots.latlong.AddressConverter;
import com.javaroots.latlong.GoogleResponse;
import com.javaroots.latlong.Result;
import com.thoughtworks.xstream.*;
import com.thoughtworks.xstream.mapper.*;

import java.io.IOException;
import java.util.Scanner;
import javax.xml.bind.JAXBContext;
import javax.xml.bind.Unmarshaller;
import java.io.FileReader;
import java.io.Reader;
import com.googlecode.jcsv.reader.*;
import com.googlecode.jcsv.annotations.internal.*;
import com.googlecode.jcsv.reader.internal.*;
import java.util.List;



public class Main {
    public int counter;


    public static void main(String[] args) {
        int counter = 0;
        /* Completed
        Heritage_datset(counter);
        Pools_Disability();
        Community_service_dataset();
         */

        //AddressTocords ("Queensland University of Technology");

        University();

    }

    private static void Community_service_dataset(){
        try {
            Reader reader = new FileReader("data/dccsds-service-locations.csv");


            CSVReader<String[]> csvReader = CSVReaderBuilder.newDefaultReader(reader);
            List<String[]> community = csvReader.readAll();
            /* betterSolution Brocken
            ValueProcessorProvider provider = new ValueProcessorProvider();
            CSVEntryParser<Community_service> entryParser = new AnnotationEntryParser<Community_service>(Community_service.class, provider);
            CSVReader<Community_service> csvCommunityReader = new CSVReaderBuilder<Community_service>(reader).entryParser(new CommunityEntryParser()).build();

            List<Community_service> community = csvCommunityReader.readAll();
            */
            Data data;
            String[] details;
            JDBCConnection connection = new JDBCConnection();
            for (int i = 74376; i < community.size(); i++) {
                connection.ConnectionStatus();
                details = community.get(i)[0].split(",");
                data = new Data(Category.SERVICES, 0, Sub_Category.FACILITIES, details[7] + " " + details[6],
                        "", Double.parseDouble(details[10]), Double.parseDouble(details[11]));
                try {
                    data.ToDatabase(connection);
                    System.out.println("Moved: " + details[7] + " " + details[6] + "   " + i + " of " + community.size());
                } catch (Exception e) {
                    System.out.println(e.getMessage());
                    System.out.println("Error moving " + details[6] + " to database");
                }
            }
            connection.CloseConnection();

        } catch (IOException e){
            System.out.println("Error in Community service Dataset");
            System.out.println(e.getMessage());
        }

    }

    private static void Pools_Disability(){
        try{

        Reader reader = new FileReader("data/Pools-location-and-information.csv");


        CSVReader<String[]> csvReader = CSVReaderBuilder.newDefaultReader(reader);
        List<String[]> disabilitypools = csvReader.readAll();

        Data data;
        String[] details;
        JDBCConnection connection = new JDBCConnection();
        for (int i = 0; i < disabilitypools.size(); i++) {
            connection.ConnectionStatus();
            details = disabilitypools.get(i)[0].split(",");
            if (details[6].equalsIgnoreCase("Yes")) {
                data = new Data(Category.SERVICES, 0, Sub_Category.POOL_DISABILITY, details[0],
                        "", Double.parseDouble(details[8]), Double.parseDouble(details[9]));
                try {
                    data.ToDatabase(connection);
                    System.out.println("Moved: " + details[0] + "   " + i + " of " + disabilitypools.size());
                } catch (Exception e) {
                    System.out.println(e.getMessage());
                    System.out.println("Error moving " + details[0] + " to database");
                }
            } else {
                System.out.println("Not diability " + details[6] );
            }

        }
        connection.CloseConnection();

    } catch (IOException e){
        System.out.println("Error in Community service Dataset");
        System.out.println(e.getMessage());
    }
    }


    private static void University(){
        try{

            Reader reader = new FileReader("data/University.csv");


            CSVReader<String[]> csvReader = CSVReaderBuilder.newDefaultReader(reader);
            List<String[]> uni = csvReader.readAll();

            Data data;
            String[] details;
            Category current;
            JDBCConnection connection = new JDBCConnection();
            for (int i = 1; i < 9; i++) {
                switch (i) {
                    case 1:
                        current = Category.NATURAL_AND_PHYSICAL_SCIENCES;
                        break;
                    case 2:
                        current = Category.INFORMATION_TECHNOLOGY;
                        break;
                    case 3:
                        current = Category.ENGINEERING;
                        break;
                    case 4:
                        current = Category.ARCHITECTURE;
                        break;
                    case 5:
                        current = Category.HEALTH;
                        break;
                    case 6:
                        current = Category.EDUCATION;
                        break;
                    case 7:
                        current = Category.BUSINESS;
                        break;
                    case 8:
                        current = Category.SOCIETY;
                        break;
                    default:
                        current = Category.ART;
                        break;
                }
                for (int j = 1; j < uni.size(); j++) {
                    connection.ConnectionStatus();
                    details = uni.get(j)[0].split(",");

                    if (!details[i].equalsIgnoreCase("0")) {
                        try {
                            data = new Data(current, 0, Sub_Category.UNIVERSITY, details[0],
                                    "", details[0], "");
                            data.ToDatabase(connection);
                            System.out.println("Moved: " + details[0] + " " + current.toString() + "   " + i + " of " + uni.size());
                        } catch (Exception e) {
                            System.out.println(e.getMessage());
                            System.out.println("Error moving " + details[0] + " to database");
                        }
                    } else {
                        System.out.println("Zero Category");
                    }

                }

            }

            connection.CloseConnection();

        } catch (IOException e){
            System.out.println("Error in Community service Dataset");
            System.out.println(e.getMessage());
        }
    }


    private static void Heritage_datset(int counter){
        try {
            FileReader reader = new FileReader("data/heritage-register.xml");
            XStream xStream = new XStream() {
                @Override
                protected MapperWrapper wrapMapper(MapperWrapper next) {
                    return new MapperWrapper(next) {
                        @Override
                        public boolean shouldSerializeMember(Class definedIn, String fieldName) {
                            if (definedIn == Object.class) {
                                try {
                                    return this.realClass(fieldName) != null;
                                } catch(Exception e) {
                                    return false;
                                }
                            } else {
                                return super.shouldSerializeMember(definedIn, fieldName);
                            }
                        }
                    };
                }
            };

            xStream.processAnnotations(heritage_places.class);
            xStream.processAnnotations(Place.class);
            heritage_places heritage = (heritage_places) xStream.fromXML(reader);


            JDBCConnection connection = new JDBCConnection();
            Data data;
            for (int i = 0; i < heritage.getPlace().size(); i++) {
                Place place = (Place) heritage.getPlace().get(i);
                data = new Data(Category.HISTORY, counter++, Sub_Category.SIGHTS, place.getName(),
                        place.getDescription(), place.getAddress(), place.getSuburb());
                try {
                    data.ToDatabase(connection);
                    System.out.println("Moved: " + place.getName() + "to database");
                } catch (Exception e){
                    System.out.println(e.getMessage());
                    System.out.println("Error moving " + place.getName() + " to database");
                }
            }
            connection.CloseConnection();

        } catch (Exception e) {
            System.out.println(e);
        }

    }

    private static void AddressTocords (String address) {
        double longitude, latitude;
        try {
            GoogleResponse res = new AddressConverter().convertToLatLong(address);
            if (res.getStatus().equals("OK")) {
                for (Result result : res.getResults()) {
                    longitude = Double.parseDouble(result.getGeometry().getLocation().getLng());
                    latitude = Double.parseDouble(result.getGeometry().getLocation().getLat());
                    System.out.println("" + longitude);
                    System.out.println("" + latitude);
                }
            } else {
                System.out.println(res.getStatus());
            }
        } catch(Exception e) {
            System.out.println("Error is converting Address");
            //System.out.println(e.getMessage());
        }

    }
}

