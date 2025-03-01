namespace SOLIDClassLibrary
{
    public class Context
    {
        public Context()
        {
            Products = new List<Product.Product>();
        }
        public List<Product.Product> Products { get; set; }
    }
}