
namespace SOLIDClassLibrary.Product
{
    // The second SOLID principle (general class)
    // The third SOLID principle (we're able to replace class with its subtype)
    public class Product
    {
        public string Id { get; set; }
        public string Name { get; set; }
        public Money.Money Price { get; private set; }
        // The first SOLID principle (enums)
        public ProductUnit Unit { get; set; }
        public Category Category { get; set; }
        public int Count { get; set; }
        public DateTime LastDeliveryDate { get; set; }
        public Product(string name, Money.Money price, ProductUnit productUnit, Category category, int count, DateTime lastDeliveryDate)
        {
            Id = Guid.NewGuid().ToString();
            Name = name;
            Price = price;
            Unit = productUnit;
            Category = category;
            Count = count;
            LastDeliveryDate = lastDeliveryDate;
        }
        public void ReducePriceByNumber(decimal number)
        {
            Price -= number;
        }
    }
}