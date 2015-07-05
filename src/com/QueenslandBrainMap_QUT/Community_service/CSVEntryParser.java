package com.QueenslandBrainMap_QUT.Community_service;

/**
 * Created by lukebusstra on 5/07/15.
 */
public interface CSVEntryParser<E> {
    public E parseEntry(String[] data);
}
