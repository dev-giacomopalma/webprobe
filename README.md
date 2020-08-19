# webProbe
PHP Library to send probes on missions to analyse websites.

## How does it work

### LaunchPad

Execute missions.

it take a **Mission** as argument for the constructor.
The method **launch()** execute the mission through the method **execute()** and return an object of type
**MissionResult**.


```
$launchPad =  new LaunchPad($mission);
$missionResult = $launchPad->launch();

```

#### MissionResult

```
class MissionResult
   {
   
       public const OK_STATUS_CODE = 200;
   
       /** @var int */
       private $statusCode;
   
       /** @var string */
       private $result; 
       ...
   ```


### Mission

A Class extending the **BaseMission** needs to implement the abstract method **execute()**
This method receive the results from the probe and it can manipulate and process the raw data.

A **Mission** as as constructor arguments the **MissionSetting** and the **Probe** objects.

```
public function __construct(MissionSetting $missionSetting, Probe $probe);
```


### Mission settings

A **MissionSetting** is an object which constructor takes as argument an array of params stored in the object and that can be used during execution of the mission if neede.
Params can be empty.

```
class MissionSetting
   {
       /** @var array */
       private $params;
   
       public function __construct(array $params = [])
       ...
   ```

### Probe

A probe is an object able to analyse a website and needs to be created implementing the interface *Probe*
It is instantiated using **ProbeSetting** as argument
The method **run()** needs to return an object of type **ProbeResult**

```
interface Probe
{
    public function __construct(ProbeSetting $probeSetting);
    public function run(): ProbeResult;
}
```

#### ProbeResult

```
class ProbeResult
{

    public const OK_STATUS_CODE = 200;

    /** @var string */
    public $statusCode;

    /** @var string */
    public $errorMessage;

    /** @var string */
    public $payload;

}
```

### ProbeSetting

An object of type ProbeSetting is instantiated with the string URL of the website page to analyse.

```
/** @var string */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
```


### Libraries

The **DiscoveryLibrary** can be extended and used in the **Probe** in order to collect information from the Page.
Available in webProbe/Libraries are
- CanonicalDiscoveryLibrary 
- PictureDiscoveryLibrary
- PriceDiscoveryLibrary (dev)
- TitleDiscoveryLibrary
- DomainDiscoveryLibrary

### ScraperHelper and PriceScraperHelper
In order to extend the capacity of **DisoveryLibrary** there are static methods available in 
**ScraperHelper** and **PriceScraperHelper** with dedicated method to read the page information.


#### Clarification around Libraries and ScraperHelper
A library is a high-level Class with dedicated method in the context of the information.
E.g. 
- method **findHTMLTitle()** of **TitleDiscoveryLibrary** is an explicit method, the context is to read the value contained in the web page title.
- in order to get this information, makes use (through the DiscoveryLibrary) of the method **ScraperHelper::readBetween**
a static operational method reading inside a tag, and used in this context for `<title></title>`

