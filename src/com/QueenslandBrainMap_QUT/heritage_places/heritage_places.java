package com.QueenslandBrainMap_QUT.heritage_places;

import java.util.List;
import java.util.ArrayList;
import com.thoughtworks.xstream.XStream;
import com.thoughtworks.xstream.annotations.XStreamAlias;
import com.thoughtworks.xstream.annotations.XStreamImplicit;
import com.thoughtworks.xstream.io.xml.StaxDriver;

/**
 * Created by lukebusstra on 4/07/15.
 */
@XStreamAlias("heritage_places")
public class heritage_places {


    @XStreamImplicit(itemFieldName = "place")
    private List place = new ArrayList();

    public List getPlace() {
        return place;
    }

}


