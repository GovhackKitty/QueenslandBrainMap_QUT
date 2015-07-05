package com.QueenslandBrainMap_QUT;


import java.sql.DriverManager;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;

/**
 * Created by lukebusstra on 4/07/15.
 */
public class JDBCConnection {
    private Connection connection;

    /**
     * Database Constructor
     */
    public JDBCConnection() {
            OpenConnection();
            System.out.println("Connecting to Database");
        }

    public void InsertToDatabase (Data data, int counter) throws SQLException{
            if (data.getLatitude() != 0){
            Statement st = connection.createStatement();
            PreparedStatement insert = connection.prepareStatement("INSERT INTO MapData VALUES (?, ?, ?, ?, ?, ?)");
            if (!st.execute("SELECT * FROM Categories WHERE category_name = '" + data.getCategory_name() + "'")) {
                st.execute("INSERT INTO Categories VALUES ('" + data.getCategory_name() + "')");
                System.out.println("add category");
            }
            if (!st.execute("SELECT sub_category FROM SubCategories WHERE sub_category = '" + data.getSub_category() + "'")) {
                st.execute("INSERT INTO SubCategories(sub_category, category) VALUES ('" + data.getSub_category() + "',  '" + data.getCategory_name() + "')");
            }

            insert.clearParameters();
            insert.setNull(1, 0);
            insert.setString(2, data.getSub_category());
            //insert.setString(3, data.getCategory_name());
            insert.setString(3, data.getName());
            insert.setDouble(4, data.getLatitude());
            insert.setDouble(5, data.getLongitude());
            insert.setString(6, data.getDescription());
            //System.out.println("before execution");
            insert.executeUpdate();
            //System.out.println("after execution");

        }

    }

    /**
     * Close the database Connection
     */
    public void CloseConnection(){
        try {
            connection.close();
            System.out.println("Closing Database");
        } catch (SQLException ex){
            System.out.println(ex.getMessage());
        }
    }

    /**
     * Opens connection to the Database
     */
    private void OpenConnection(){
        try {
            String url = "jdbc:mysql://121.208.45.247:3306/Knowledge_Maps";
            String username = "root";
            String password = "govhack";

            connection = DriverManager.getConnection(url, username, password);
        } catch (SQLException sqle){
            System.out.println("Error Connection: " + sqle.getMessage());
        }
    }

    /**
     * Checks the status of the database
     * @throws SQLException
     */
    public void ConnectionStatus() throws SQLException {
        if (connection == null){
            OpenConnection();
        } else if (connection.isClosed()) {
            OpenConnection();
        }

    }
}



