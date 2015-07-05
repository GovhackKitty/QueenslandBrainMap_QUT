package com.javaroots.latlong;

/**
 *
 *
 * @author Abhishek Somani
 * http://www.javaroots.com/2013/08/convert-location-lat-long-java.html
 */
public class GoogleResponse {


    private Result[] results ;
    private String status ;
    public Result[] getResults() {
        return results;
    }
    public void setResults(Result[] results) {
        this.results = results;
    }
    public String getStatus() {
        return status;
    }
    public void setStatus(String status) {
        this.status = status;
    }

}