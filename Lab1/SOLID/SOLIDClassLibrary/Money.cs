namespace SOLIDClassLibrary.Money
{
    // The second SOLID principle (general class)
    // The third SOLID principle (we're able to replace class with its subtype)
    public class Money
    {
        public int IntegerPart { get; private set; }
        public int FractionalPart { get; private set; }
        public Money(int integerPart, int fractionalPart)
        {
            if (!isCorrectMoney(integerPart, fractionalPart))
            {
                throw new Exception("Грошові частини не можуть бути від’ємними або дробова частина не може перевищувати 99");
            }
            IntegerPart = integerPart;
            FractionalPart = fractionalPart;
        }
        public override string ToString()
        {
            return $"{IntegerPart}.{FractionalPart}";
        }
        public decimal ConvertToDecimal()
        {
            return decimal.Parse($"{IntegerPart}.{FractionalPart}");
        }
        public override bool Equals(object? obj)
        {
            if ((obj == null) || !GetType().Equals(obj.GetType()))
                return false;
            Money money = (Money) obj;
            return (IntegerPart == money.IntegerPart) && (FractionalPart == money.FractionalPart);
        }
        private static bool isCorrectMoney(int intPart, int fracPart)
        {
            return intPart >= 0 && (fracPart >= 0 && fracPart <= 99);
        }
        public override int GetHashCode()
        {
            return HashCode.Combine(IntegerPart, FractionalPart);
        }
        public static Money operator +(Money m1, Money m2)
        {
            int newIntPart, newFracPart;
            if (m1.FractionalPart + m2.FractionalPart >= 100)
            {
                newFracPart = m1.FractionalPart + m2.FractionalPart - 100;
                newIntPart = m1.IntegerPart + m2.IntegerPart + 1;
            }
            else
            {
                newFracPart = m1.FractionalPart + m2.FractionalPart;
                newIntPart = m1.IntegerPart + m2.IntegerPart;
            }
            return new Money(newIntPart, newFracPart);
        }
        public static Money operator -(Money m1, Money m2)
        {
            int newIntPart, newFracPart;
            if (m1.FractionalPart - m2.FractionalPart < 0)
            {
                newFracPart = m1.FractionalPart - m2.FractionalPart + 100;
                newIntPart = m1.IntegerPart - m2.IntegerPart - 1;
            }
            else
            {
                newFracPart = m1.FractionalPart - m2.FractionalPart;
                newIntPart = m1.IntegerPart - m2.IntegerPart;
            }
            if (!isCorrectMoney(newIntPart, newFracPart))
            {
                throw new Exception("Результат віднімання не може бути негативним");
            }
            return new Money(newIntPart, newFracPart);
        }
        public static Money operator -(Money m1, decimal num)
        {
            if (num <= 0)
            {
                throw new Exception("Число не може бути рівним або меншим за нульo");
            }
            int intPart = (int)Math.Truncate(num);
            int floatPart = (int)(num - Math.Truncate(num)) * 100;
            if (floatPart >= 100)
            {
                throw new Exception("Частина float не може перевищувати 99");
            }
            Money result = m1 - new Money(intPart, floatPart);
            if (!isCorrectMoney(result.IntegerPart, result.FractionalPart))
            {
                throw new Exception("Результат віднімання не може бути від’ємним або частина з плаваючою точкою не може перевищувати 99");
            }
            return m1 - new Money(intPart, floatPart);
        }
    }
}