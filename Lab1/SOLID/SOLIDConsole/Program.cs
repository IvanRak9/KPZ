using System.Text;
using SOLIDClassLibrary;
using SOLIDClassLibrary.Warehouse;
using Newtonsoft.Json.Linq;
using SOLIDClassLibrary.FileWorker;
using SOLIDClassLibrary.Money;
using SOLIDClassLibrary.Product;
using SOLIDClassLibrary.Reporting;

string reportingFile = GetItemFromConfig("ReportFilePath");
FileWorker fileWorker = new(reportingFile);
fileWorker.Clear();
Reporting reporting = new(fileWorker.Append);
Context context = new();
WarehouseRepository warehouseRepository = new(context, reporting);
Warehouse warehouse = new(warehouseRepository);
warehouse.AddProduct(new Product("Hyperx Cloud Alpha", new Money(3000, 00), ProductUnit.Pieces, Category.Headphones, 1, new DateTime(2022, 5, 21)));
warehouse.UpdateProduct("1", new Product("Hyperx Cloud II", new Money(3500, 00), ProductUnit.Pieces, Category.Headphones, 1, new DateTime(2022, 8, 18)));

static string GetItemFromConfig(string key)
{
    try
    {
        string json = File.ReadAllText("../../../Config.json", Encoding.UTF8);
        string data = JObject.Parse(json)[key].ToString();
        return data;
    }
    catch (Exception)
    {
        throw new Exception("Помилка під час читання Config.json");
    }
}