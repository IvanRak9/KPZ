namespace SOLIDClassLibrary.Warehouse
{
    public class Warehouse
    {
        private readonly IWarehouseRepository _warehouseRepository;
        // The fifth SOLID principle (interface was created and pasted in as constructor parameter)
        public Warehouse(IWarehouseRepository warehouseRepository)
        {
            _warehouseRepository = warehouseRepository;
        }
        public void AddProduct(Product.Product product)
        {
            _warehouseRepository.AddProduct(product);
        }    
        public void DeleteProduct(Product.Product product)
        {
            _warehouseRepository.RemoveProduct(product);
        }
        public void UpdateProduct(string id, Product.Product product)
        {
            _warehouseRepository.UpdateProduct(id, product);
        }  
        public Product.Product? GetProductByIdOrDefault(string id)
        {
            return _warehouseRepository.GetProductByIdOrDefault(id);
        }  
        public Product.Product? GetProductByNameOrDefault(string name)
        {
            return _warehouseRepository.GetProductByNameOrDefault(name);
        }  
    }
}