using SOLIDClassLibrary.Reporting;

namespace SOLIDClassLibrary.Warehouse
{
    public class WarehouseRepository : IWarehouseRepository
    {
        private readonly Context _context;
        private readonly IReporting _reporting;
        public WarehouseRepository(Context context, IReporting reporting)
        {
            _context = context;
            _reporting = reporting;
        }
        public void AddProduct(Product.Product product)
        {
            _context.Products.Add(product);
            _reporting.Added();
            _reporting.Left(_context.Products.Count);
        }
        public void RemoveProduct(Product.Product product)
        {
            _context.Products.Remove(product);
            _reporting.Removed();
            _reporting.Left(_context.Products.Count);
        }
        public void UpdateProduct(string productId, Product.Product newProduct)
        {
            Product.Product? product = _context.Products.FirstOrDefault(p => p.Id == productId);
            if (productId == null)
            {
                throw new Exception("Товар не знайдено");
            }
            product = newProduct;
        }
        public Product.Product? GetProductByIdOrDefault(string id)
        {
            return _context.Products.FirstOrDefault(p => p.Id == id);
        }
        public Product.Product? GetProductByNameOrDefault(string name)
        {
            return _context.Products.FirstOrDefault(p => p.Name == name);
        }
    }
}