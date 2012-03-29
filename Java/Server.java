import java.io.*;
import java.net.*;
import java.awt.*;
import javax.swing.*;
import java.util.*;

public class Exercise30_1Server extends JFrame {
    private JTextArea jta = new JTextArea();
    
    public static void main(String[] args) {
        new Exercise30_1Server();
    }
    
    public Exercise30_1Server() {
        setLayout(new BorderLayout());
        add(new JScrollPane(jta), BorderLayout.CENTER);

        setTitle("Exercise30.1 Server");
        setSize(500, 300);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setVisible(true); 
        
        try {
            ServerSocket serverSocket = new ServerSocket(8000);
            jta.append("Server started at " + new Date() + '\n');

            Socket socket = serverSocket.accept();

            DataInputStream inputFromClient = new DataInputStream(socket.getInputStream());
            DataOutputStream outputToClient = new DataOutputStream(socket.getOutputStream());

            while (true) {
                double rate = inputFromClient.readDouble();
                double years = inputFromClient.readDouble();
                double amount = inputFromClient.readDouble();
                
                double monthlyIR = rate / 1200;
                double monthly = amount * monthlyIR /(1 - (Math.pow(1 / (1 + monthlyIR), years * 12)));
                double total = monthly * years * 12;

                outputToClient.writeDouble(monthly);
                outputToClient.writeDouble(total);

                jta.append("Annual Interest Rate: " + rate + '\n');
                jta.append("Number of Years: " + years + '\n');
                jta.append("Loan Amount: " + amount + '\n');
                jta.append("Monthly Payment: " + monthly + '\n');
                jta.append("Total Payment: " + total + '\n');
            }
        }
        catch(IOException ex) {
            System.err.println(ex);
        }
    }
}
