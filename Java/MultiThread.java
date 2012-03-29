import javax.swing.*;
import java.awt.*;

public class TaskThreadDemo extends JFrame {
    public static JTextArea jTA;
    
  public static void main(String[] args) {
      TaskThreadDemo frame = new TaskThreadDemo();
      frame.pack();
      frame.setTitle("TaskThreadDemo");
      frame.setSize(500, 200);
      frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
      frame.setVisible(true);
      
    // Create tasks
    Runnable printA = new PrintChar('a', 100);
    Runnable printB = new PrintChar('b', 100);
    Runnable print100 = new PrintNum(100);

    // Create threads
    Thread thread1 = new Thread(printA);
    Thread thread2 = new Thread(printB);
    Thread thread3 = new Thread(print100);

    // Start threads
    thread1.start();
    thread2.start();
    thread3.start();
  }
  public TaskThreadDemo() {
      JPanel p1 = new JPanel();
      p1.setLayout(new FlowLayout(FlowLayout.LEFT));
      p1.add(jTA = new JTextArea(10, 43));
      jTA.setLineWrap(true);
      jTA.setWrapStyleWord(true);
      
      getContentPane().add(p1);
  }
}

// The task for printing a specified character in specified times
class PrintChar implements Runnable {
  private char charToPrint; // The character to print
  private int times; // The times to repeat

  /** Construct a task with specified character and number of
   *  times to print the character
   */
  public PrintChar(char c, int t) {
    charToPrint = c;
    times = t;
  }

  /** Override the run() method to tell the system
   *  what the task to perform
   */
  public void run() {     
      for (int i = 0; i < times; i++) {
          String str = String.valueOf(charToPrint);
          TaskThreadDemo.jTA.append(str);
        }
    }
}
// The task class for printing number from 1 to n for a given n
class PrintNum implements Runnable {
  private int lastNum;

  /** Construct a task for printing 1, 2, ... i */
  public PrintNum(int n) {
    lastNum = n;
  }

  /** Tell the thread how to run */
  public void run() {
    for (int i = 1; i <= lastNum; i++) {
        String s = String.valueOf(i);
        TaskThreadDemo.jTA.append(" " + s);
    }
  }
}

