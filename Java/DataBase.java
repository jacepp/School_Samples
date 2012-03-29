import javax.swing.*;
import java.sql.*;
import java.awt.*;
import java.awt.event.*;

public class dataBase extends JApplet {
    private JButton batchBtn, nonBtn;
    private JTextArea jta=new JTextArea();
    private JLabel batchLbl = new JLabel();
    private JLabel connectLbl = new JLabel();

    private Statement statement;
    private Connection connection;

    boolean batchUpdatesSupported;

    String sqlInsert = "insert into lab (num) values (";

    public void init() {
        initializeDB();

        JPanel p1 = new JPanel();
        p1.setLayout(new FlowLayout());
        p1.add(batchLbl);
        p1.add(connectLbl);

        JPanel p2 = new JPanel();
        p2.setLayout(new FlowLayout());
        p2.add(batchBtn = new JButton("Batch Update"));
        p2.add(nonBtn = new JButton("Non-Batch Update"));

        getContentPane().setLayout(new BorderLayout());
        getContentPane().add(p1, BorderLayout.NORTH);
        getContentPane().add(p2, BorderLayout.SOUTH);
        getContentPane().add(new JScrollPane(jta), BorderLayout.CENTER);

        batchBtn.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
            batchBtn_actionPerformed(e);
            }
        });

        nonBtn.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
            nonBtn_actionPerformed(e);
            }
        });
    }

    private void initializeDB() {
        try {
            Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");

            System.out.println("Driver loaded");

            connection = DriverManager.getConnection
            ("jdbc:odbc:38.1");

            connectLbl.setText("Database Connected");

            statement = connection.createStatement();
            }
        catch (Exception ex) {
            ex.printStackTrace();
        }
    }

    private void batchBtn_actionPerformed(ActionEvent e) {
        try {
            try {
                if(connection.getMetaData().supportsBatchUpdates())
                    batchUpdatesSupported = true;
            }
            catch (UnsupportedOperationException ex) {
                System.out.println("The driver does not support JDBC 2");
            }

            if(batchUpdatesSupported) {
                long startTime = System.currentTimeMillis();

                for(int i = 0; i <= 1000; i++){
                    statement.addBatch(sqlInsert + (int) (Math.random() * 1000) + ")");
                }

                statement.executeBatch();

                long endTime = System.currentTimeMillis();
                long time = endTime - startTime;

                batchLbl.setText("Batch Update Succeeded");

                jta.append("Batch update completed " + '\n' + "The elapsed time is " + time);
            }
        }
        catch (SQLException ex) {
            System.out.println(ex);
        }
    }

    private void nonBtn_actionPerformed(ActionEvent e) {
        try {
            long startTime = System.currentTimeMillis();

            for(int i = 0; i <= 1000; i++){
                String queryString = "insert into lab (num) values (" + (int) (Math.random() * 1000) + ")";
                statement.executeUpdate(queryString);
            }

            long endTime = System.currentTimeMillis();
            long time = endTime - startTime;
//System.out.println("a1");
           jta.append("Non-batch update completed" + '\n' + "The elapsed time is " +time);
        //   System.out.println("a2");
        }
        catch(SQLException ex) {
            ex.printStackTrace();
        }
    }

    public static void main(String[] args) {
        dataBase applet = new dataBase();
        JFrame frame = new JFrame();
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setTitle("Batch");
        frame.getContentPane().add(applet, BorderLayout.CENTER);
        applet.init();
        applet.start();
        frame.setSize(400, 300);
        frame.setLocationRelativeTo(null);
        frame.setVisible(true);
    }
}
