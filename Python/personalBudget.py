def main():
    endProgram = 'no'

    displayMenu()
    
    while endProgram == 'no':
        choice = input('Enter your selection: ')
        
        while not choice == 5:
            inputValidation(choice)
            displayMenu()
            choice = input('Enter your selection: ')

        endProgram = raw_input('Would you like to end the program?(Enter yes or no) ')

    print "Goodbye!"

def inputValidation(choice):
    while not (choice == 1 or choice == 2 or choice == 3 or choice == 4 or choice == 5):
            choice = input('Re-enter your selection: ')

    if choice == 1:
        addExpense()
    elif choice == 2:
        removeExpense()
    elif choice == 3:
        addRevenue()
    elif choice == 4:
        removeRevenue()

def displayMenu():
    print 'Menu Selections'
    print '1 - Add an Expense'
    print '2 - Remove an Expense'
    print '3 - Add Revenue'
    print '4 - Remove Revenue'
    print '5 - Exit'

def addExpense():
    endAddExpense = 'yes'
    global totalExpense
    global totalBudget
    totalExpense = 0

    while endAddExpense == 'yes':
        totalBudget = input('Enter your current budget amount: ')
        addExpense = input('Enter added expense amount: ')
        frequency = input('Enter how many times a month this expense happens: ')

        totalAddExpense = addExpense * frequency

        if  totalAddExpense > totalBudget:
            print 'Budget was exceeded!'
        else:
            totalBudget = totalBudget -  totalAddExpense
            totalExpense = totalExpense + totalAddExpense
            print 'Expense was accepted.'
            print 'Monthly budget after added expense is $',totalBudget
            print 'Total expenses are $', totalExpense

        endAddExpense = raw_input('Would you like to add another expense?(Enter yes or no) ')    

def removeExpense():
    endRemoveExpense = 'yes'    

    while endRemoveExpense == 'yes':
        totalBudget = input('Enter your current budget amount: ')
        totalExpense = input('Enter your current total expense: ')
        expense = input('Enter the expense amount you would like to remove: ')
        frequency = input('How often does this expense happen: ')
        removeExpense = expense * frequency

        if removeExpense <= totalExpense:
            totalExpense = totalExpense - removeExpense
            totalBudget = totalBudget + removeExpense
            print 'Monthly budget after removed expense is $',totalBudget
            print 'Total expenses are $',totalExpense
        else:
            print 'Error re-check expense amounts.'

        endRemoveExpense = raw_input('Would you like to remove another expense?(Enter yes or no) ')

def addRevenue():
    endAddRevenue = 'yes'

    while endAddRevenue == 'yes':
        totalBudget = input('Enter your current budget amount: ')
        addRevenue = input('Enter the amount of increased monthly income: ')
        totalBudget = totalBudget + addRevenue
        print 'Your new budget is $',totalBudget

        endAddRevenue = raw_input('Would you like to add another income?(Enter yes or no) ')

def removeRevenue():
    endRemoveRevenue = 'yes'

    while endRemoveRevenue == 'yes':
        totalBudget = input('Enter your current budget amount: ')
        removeRevenue = input('Enter the amount of decreased monthly income: ')
        totalBudget = totalBudget - removeRevenue

        if totalBudget <= 0:
            print 'Your current budget is now $',totalBudget
        else:
            print 'You new monthly budget is $',totalBudget

        endRemoveRevenue = raw_input('Would you like to remove another income?(Enter yes or no) ')
    
main()
    
    
    
    
