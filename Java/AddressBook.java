import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class Project2 extends JApplet {
    String gender;
    
    private JTextArea jta = new JTextArea();
    
    private JTextField jtf1 = new JTextField(10);
    private JTextField jtf2 = new JTextField(10);
    private JTextField jtf3 = new JTextField(10);
    
    private JButton jbtn = new JButton("SUBMIT");
    private JButton jbtn1 = new JButton("CLEAR");
    private JButton jbtn2 = new JButton("NEW ENTRY");
    
    private JRadioButton jrb1 = new JRadioButton("Male: ");
    private JRadioButton jrb2 = new JRadioButton("Female: ");
    
    private JCheckBox jchk1 = new JCheckBox("Show Text Area");
    
    private JCheckBoxMenuItem jcbmi = new JCheckBoxMenuItem();
    
    private JMenuItem jmiSubmit, jmiClear, jmiNewEntry, jmiExit, jmiGender, jmiFName, jmiLName, jmiAge, jmiAbout;
    
    private String[] ages = {"1", "2", "3", "4", "5",
                            "6", "7", "8", "9", "10",
                            "11", "12", "13", "14", "15",
                            "16", "17", "18", "19", "20",
                            "21", "22", "23", "24", "25",
                            "26", "27", "28", "29", "30",
                            "31", "32", "33", "34", "35",
                            "36", "37", "38", "39", "40",
                            "41", "42", "43", "44", "45",
                            "46", "47", "48", "49", "50",
                            "51", "52", "53", "54", "55",
                            "56", "57", "58", "59", "60",
                            "61", "62", "63", "64", "65",
                            "66", "67", "68", "69", "70",
                            "71", "72", "73", "74", "75"};
							
    public Project2() {
        jta.setVisible(false);
        
        JMenuBar jmb = new JMenuBar();
        setJMenuBar(jmb);
        
        JMenu fileMenu = new JMenu("File");
        JMenu infoMenu = new JMenu("Information");
        JMenu helpMenu = new JMenu("Help");
        
        jmb.add(fileMenu);
        jmb.add(infoMenu);
        jmb.add(helpMenu);
        
        fileMenu.add(jmiNewEntry = new JMenuItem("New Entry"));
        fileMenu.add(jmiClear = new JMenuItem("Clear"));
        fileMenu.addSeparator();
        fileMenu.add(jmiSubmit = new JMenuItem("Submit"));
        jmiSubmit.setIcon(new ImageIcon(getClass().getResource("image/not.gif")));
        fileMenu.addSeparator();
        fileMenu.add(jmiExit = new JMenuItem("Exit"));
        jmiExit.setIcon(new ImageIcon(getClass().getResource("image/cross.gif")));
        
        infoMenu.add(jmiFName = new JMenuItem("First Name"));
        infoMenu.add(jmiLName = new JMenuItem("Last Name"));
        infoMenu.add(jmiAge = new JMenuItem("Age"));
        infoMenu.addSeparator();
        infoMenu.add(jmiGender = new JMenuItem("Gender"));
        
        helpMenu.add(jmiAbout = new JMenuItem("About"));
        helpMenu.addSeparator();
        helpMenu.add(jcbmi = new JCheckBoxMenuItem("Show TextArea"));
        
        JPanel p1 = new JPanel();
        p1.setLayout(new GridLayout(3, 1, 0, 4));
        p1.add(new JLabel("First Name: "));
        p1.add(new JLabel("Last Name: "));
        p1.add(new JLabel("Age: "));
        
        JPanel p2 = new JPanel();
        p2.setLayout(new GridLayout(3, 1));
        p2.add(jtf1);
        jtf1.setHorizontalAlignment(JTextField.RIGHT);
        p2.add(jtf2);
        jtf2.setHorizontalAlignment(JTextField.RIGHT);
        p2.add(jtf3);
        jtf3.setHorizontalAlignment(JTextField.RIGHT);
        
        JPanel p3 = new JPanel();
        p3.setLayout(new GridLayout(2, 1));
        p3.add(jrb1);
        p3.add(jrb2);
        
        final ButtonGroup group = new ButtonGroup();
        group.add(jrb1);
        group.add(jrb2);
        
        jrb1.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                jta.setBackground(Color.CYAN);
                gender = "Male";
            }
        });
        
        jrb2.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                jta.setBackground(Color.PINK);
                gender = "Female";
            }
        });
 
        JPanel p4 = new JPanel();
        p4.setLayout(new FlowLayout());
        p4.add(jchk1);
        
        jchk1.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                if (jchk1.isSelected())
                    jta.setVisible(true);
                
                if (!jchk1.isSelected())
                    jta.setVisible(false);
            }
        });
        
        JPanel p5 = new JPanel();
        p5.setLayout(new BorderLayout());
        p5.add(new JScrollPane(jta), BorderLayout.CENTER);
        
        JPanel p6 = new JPanel();
        p6.setLayout(new FlowLayout());
        p6.add(p1);
        p6.add(p2);
        p6.add(p3);
        p6.add(p4);
        
        JPanel p7 = new JPanel();
        p7.setLayout(new GridLayout(1, 1));
        p7.add(jbtn1);
        p7.add(jbtn2);
        p7.add(jbtn);
        
        jbtn.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                jta.append("First Name: " + jtf1.getText() + '\n'
                        + "Last Name: " + jtf2.getText() + '\n'
                        + "Age: " + jtf3.getText() + '\n'
                        + gender + '\n' + '\n');
                jbtn.setEnabled(false);
                jtf1.setVisible(false);
                jtf2.setVisible(false);
                jtf3.setVisible(false);
            }
        });
        
        jbtn1.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                jta.setText("");
                jtf1.setText("");
                jtf2.setText("");
                jtf3.setText("");
                group.clearSelection();
                jta.setBackground(Color.WHITE);
                jchk1.setSelected(false);
                jta.setVisible(false);
                gender = "";
            }
        });
        
        jbtn2.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                jtf1.setText("");
                jtf2.setText("");
                jtf3.setText("");
                jbtn.setEnabled(true);
                jtf1.setVisible(true);
                jtf2.setVisible(true);
                jtf3.setVisible(true);
            }
        });
        
        jmiNewEntry.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int x = JOptionPane.showConfirmDialog(null, "Did you want to start a new entry?", "Confirm New Entry",
                        JOptionPane.YES_NO_OPTION);
                if(x < 1){
                    jtf1.setText("");
                    jtf2.setText("");
                    jtf3.setText("");
                    jbtn.setEnabled(true);
                    jtf1.setVisible(true);
                    jtf2.setVisible(true);
                    jtf3.setVisible(true);
                }
            }
        });
        
        jmiClear.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int x = JOptionPane.showConfirmDialog(null, "Would you like to clear the form?", "Clear Confirm",
                        JOptionPane.OK_CANCEL_OPTION);
                if(x < 1){
                    jta.setText("");
                    jtf1.setText("");
                    jtf2.setText("");
                    jtf3.setText("");
                    group.clearSelection();
                    jta.setBackground(Color.WHITE);
                    jchk1.setSelected(false);
                    jta.setVisible(false);
                    gender = "";
                }
            }
        });
        
        jmiSubmit.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(null, "You information has been submitted", "Information Submitted", 
                        JOptionPane.WARNING_MESSAGE);
                jta.append("First Name: " + jtf1.getText() + '\n'
                        + "Last Name: " + jtf2.getText() + '\n'
                        + "Age: " + jtf3.getText() + '\n'
                        + gender + '\n' + '\n');
                jbtn.setEnabled(false);
                jtf1.setVisible(false);
                jtf2.setVisible(false);
                jtf3.setVisible(false);
            }
        });
        
        jmiExit.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int x = JOptionPane.showOptionDialog(null, "Was exiting the program what you really wanted?", "Exit Options", 
                        JOptionPane.DEFAULT_OPTION, JOptionPane.PLAIN_MESSAGE, null, new Object[]{"Duh!", "Woops!"}, "Woops!");
                if(x < 1)
                    System.exit(0);
            }
        });
        
        jmiFName.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                String fName = JOptionPane.showInputDialog("Enter your first name:");
                jtf1.setText(fName);
            }
        });
        
        jmiLName.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                String lName = JOptionPane.showInputDialog("Enter your last name:");
                jtf2.setText(lName);
            }
        });
        
        jmiAge.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                Object obj = JOptionPane.showInputDialog(null, "Pew Pew Pew", "List", JOptionPane.QUESTION_MESSAGE, null, ages, ages[0]);
                String s = obj.toString();
                jtf3.setText(s);
            }
        });
        
        jmiGender.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int x = JOptionPane.showOptionDialog(null, "Please Choose a Gender ", "Gender Options", 
                        JOptionPane.DEFAULT_OPTION, JOptionPane.PLAIN_MESSAGE, null, new Object[]{"Male", "Female"}, "Male");
                if (x > 0){
                    jta.setBackground(Color.PINK);
                    gender = "Female";
                    jrb2.setSelected(true);
                }
                else {
                    jta.setBackground(Color.CYAN);
                    gender = "Male";
                    jrb1.setSelected(true);
                }
            }
        });
        
        jmiAbout.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(null, "Full of Fun and Excitement", "About", JOptionPane.INFORMATION_MESSAGE);
            }
        });
        
        jcbmi.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                if (jcbmi.isSelected()){
                    jta.setVisible(true);
                    jchk1.setSelected(true);
                }
                
                if (!jcbmi.isSelected()){
                    jta.setVisible(false);
                    jchk1.setSelected(false);
                }
            }
        });
        
        getContentPane().setLayout(new BorderLayout());
        getContentPane().add(p6, BorderLayout.NORTH);
        getContentPane().add(p5, BorderLayout.CENTER);
        getContentPane().add(p7, BorderLayout.SOUTH);
    }
    
    public static void main(String[] args) {
        JFrame frame = new JFrame("Project 2");
         
        JApplet applet = new Project2();

        frame.add(applet, BorderLayout.CENTER);
        
        applet.init();

        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(450, 300);
        frame.setVisible(true);
    }
}
