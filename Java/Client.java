import java.io.*;
import java.net.*;
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class Exercise30_1Client extends JFrame implements ActionListener {
    String host = "localhost";
    
    private JTextArea jta = new JTextArea(5, 47);    
    private JTextField jtf1 = new JTextField(20);
    private JTextField jtf2 = new JTextField(20);
    private JTextField jtf3 = new JTextField(20);
    private JButton jbtn; 
    
    private DataOutputStream toServer;
    private DataInputStream fromServer;
    
    public static void main(String[] args) {
        new Exercise30_1Client();
    }
    
    public Exercise30_1Client() {
        JPanel p1 = new JPanel();
        p1.setLayout(new GridLayout(3, 1));
        p1.add(new JLabel("Annual Interest Rate"));
        p1.add(new JLabel("Number of Years"));
        p1.add(new JLabel("Loan Amount"));
        
        JPanel p2 = new JPanel();
        p2.setLayout(new GridLayout(3, 1));
        p2.add(jtf1);
        jtf1.setHorizontalAlignment(JTextField.RIGHT);
        p2.add(jtf2);
        jtf2.setHorizontalAlignment(JTextField.RIGHT);
        p2.add(jtf3);
        jtf3.setHorizontalAlignment(JTextField.RIGHT);
                
        JPanel p3 = new JPanel();
        p3.setLayout(new BorderLayout());
        p3.add(jbtn = new JButton("Submit"), BorderLayout.CENTER);
              
        JPanel p4 = new JPanel();
        p4.add(new JScrollPane(jta), BorderLayout.CENTER);
        
        getContentPane().setLayout(new BorderLayout());
        getContentPane().add(p1, BorderLayout.WEST);
        getContentPane().add(p2, BorderLayout.CENTER);
        getContentPane().add(p3, BorderLayout.EAST);
        getContentPane().add(p4, BorderLayout.SOUTH);
        
        jbtn.addActionListener(this);
        
        pack();
        setTitle("Exercise30.1 Client");
        setSize(540, 200);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setVisible(true);
        
        try {
            Socket socket = new Socket(host, 8000);
            
            fromServer = new DataInputStream(socket.getInputStream());
            toServer = new DataOutputStream(socket.getOutputStream());    
        }
        catch (IOException ex) {
            jta.append(ex.toString() + '\n');
        }
    }
    
    public void actionPerformed(ActionEvent e) {
        try {
             
        double rate = Double.parseDouble(jtf1.getText().trim());
        double years = Double.parseDouble(jtf2.getText().trim());
        double amount = Double.parseDouble(jtf3.getText().trim());
        
        toServer.writeDouble(rate);
        toServer.writeDouble(years);
        toServer.writeDouble(amount);
        toServer.flush();
        
        double monthly = fromServer.readDouble();
        double total = fromServer.readDouble();
        
        jta.append("Monthly Payment: " + monthly + '\n');
        jta.append("Total Payment:" + total + '\n');
        
        }
        catch (IOException ex) {
            System.err.println(ex);
        }
    }
    
}
