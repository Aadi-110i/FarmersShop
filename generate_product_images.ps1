
# Generate all remaining product images via belt CLI
# Usage: .\generate_product_images.ps1

$outputDir = "d:\Projects\MVC\public\images\products"
$tmpJson   = "d:\Projects\MVC\belt_input.json"

$products = @(
    # Seeds (remaining 4)
    @{ file = "seed_chilli";     prompt = "Professional close-up product photography of dried red Teja chillies and chilli seeds in a rustic wooden bowl, scattered chillies on burlap, vibrant red tones, warm studio lighting, premium agricultural product photo" },
    @{ file = "seed_soybean";    prompt = "Professional close-up product photography of certified soybean seeds piled in a small burlap sack spilling onto wooden surface, pale yellow-green beans, soft natural daylight, earthy warm tones, premium agricultural photo" },
    @{ file = "seed_onion";      prompt = "Professional close-up product photography of tiny black onion seeds in a ceramic dish with fresh red Nasik onions in background, rich dark tones, soft studio lighting, premium agricultural product photography" },
    @{ file = "seed_sunflower";  prompt = "Professional close-up product photography of sunflower seeds in a terracotta bowl with a bright sunflower bloom beside it, golden warm tones, natural sunlight, premium agricultural product photography" },

    # Manures (5)
    @{ file = "manure_cowdung";       prompt = "Professional product photography of organic composted cow dung manure in a burlap bag on a farm, rich dark brown organic matter, straw and soil nearby, warm natural lighting, earthy agricultural tones" },
    @{ file = "manure_vermicompost";  prompt = "Professional close-up product photography of rich dark vermicompost in a terracotta pot, crumbly dark soil texture, earthworms visible, lush green plant nearby, organic earthy tones, premium agricultural photo" },
    @{ file = "manure_chicken";       prompt = "Professional product photography of organic chicken litter manure in a open burlap sack on farm ground, high-nitrogen organic fertilizer, hay in background, warm earthy tones, premium agricultural product photo" },
    @{ file = "manure_greenleaf";     prompt = "Professional close-up product photography of crushed green leaf mulch and biomass in a garden setting, lush fresh green leaves and shredded plant matter, organic earthy tones, premium agricultural product photo" },
    @{ file = "manure_bioslurry";     prompt = "Professional product photography of liquid organic bio-slurry compost in a dark bottle and poured into soil on a farm, rich brown organic liquid, green crop field background, premium agricultural product photo" },

    # Fertilizers (8)
    @{ file = "fert_urea";        prompt = "Professional close-up product photography of white urea fertilizer granules in a glass bowl and scattered on wooden surface, pristine white crystalline pellets, clean studio lighting, premium agricultural product photo" },
    @{ file = "fert_dap";         prompt = "Professional close-up product photography of DAP diammonium phosphate fertilizer granules in a small sack, dark brown granules spilling on burlap, warm earthy studio lighting, premium agricultural product photography" },
    @{ file = "fert_npk";         prompt = "Professional close-up product photography of colorful NPK fertilizer granules in a glass bowl, mixed blue green and white pellets, clean studio lighting on white surface, premium agricultural product photo" },
    @{ file = "fert_potash";      prompt = "Professional close-up product photography of potash MOP fertilizer, pink-red crystalline granules in a ceramic dish and scattered on wooden surface, warm studio lighting, premium agricultural product photo" },
    @{ file = "fert_zincsulphate";prompt = "Professional close-up product photography of zinc sulphate fertilizer powder in a glass jar, white crystalline powder on lab surface, clean studio background, premium agricultural chemistry product photo" },
    @{ file = "fert_liquidzinc";  prompt = "Professional product photography of liquid chelated zinc fertilizer in a labeled spray bottle and being poured, clear amber liquid, green crop leaves in background, premium agricultural product photo" },
    @{ file = "fert_biopotash";   prompt = "Professional product photography of organic bio-potash liquid fertilizer in a dark amber bottle on a farm setting, organic label, green fruiting plants in background, premium agricultural product photo" },
    @{ file = "fert_sulfur";      prompt = "Professional close-up product photography of elemental soil sulfur powder in a small bag and scattered on burlap, bright yellow sulfur powder, warm studio lighting, premium agricultural product photo" },

    # Tools (7)
    @{ file = "tool_spade";       prompt = "Professional product photography of a hardened steel garden spade standing in rich brown soil, wooden handle, clean farm background, warm natural light, premium agricultural tools product photo" },
    @{ file = "tool_seeder";      prompt = "Professional product photography of a manual row seeder tool on a cultivated field, precision seed sowing device with funnel and wheel, warm daylight, premium agricultural tools product photo" },
    @{ file = "tool_sprayer";     prompt = "Professional product photography of a 16-litre knapsack backpack sprayer on a white background, red plastic tank with pump and nozzle, clean studio lighting, premium agricultural tools product photo" },
    @{ file = "tool_rake";        prompt = "Professional product photography of an iron garden rake with 12 strong teeth lying on a tilled farm field, wooden handle, warm natural lighting, premium agricultural tools product photo" },
    @{ file = "tool_pickaxe";     prompt = "Professional product photography of a double-headed heavy iron ground pickaxe lying on rocky farm soil, strong wooden handle, warm earthy tones, premium agricultural tools product photo" },
    @{ file = "tool_sickle";      prompt = "Professional close-up product photography of a sharp high-carbon steel harvesting sickle on a wooden surface with golden wheat crop in background, curved blade, warm earthy tones, premium agricultural product photo" },
    @{ file = "tool_phmonitor";   prompt = "Professional product photography of a digital soil pH and moisture monitor/tester on a farm, electronic device with probe inserted in soil, green crop background, clean product photography" }
)

$totalProducts = $products.Count
$successCount  = 0
$failedProducts = @()

Write-Host "=== TerraMarket Product Image Generator ===" -ForegroundColor Cyan
Write-Host "Generating $totalProducts product images...`n" -ForegroundColor White

foreach ($p in $products) {
    $outFile = Join-Path $outputDir "$($p.file).png"

    # Skip if already exists
    if (Test-Path $outFile) {
        Write-Host "  [SKIP] $($p.file) already exists" -ForegroundColor Yellow
        $successCount++
        continue
    }

    Write-Host "  Generating: $($p.file) ..." -ForegroundColor Gray

    # Write JSON input file (UTF-8 WITHOUT BOM — belt CLI requires this)
    $jsonContent = @{ prompt = $p.prompt } | ConvertTo-Json -Compress
    $utf8NoBom = [System.Text.UTF8Encoding]::new($false)
    [System.IO.File]::WriteAllText($tmpJson, $jsonContent, $utf8NoBom)

    # Run belt and capture output
    $beltOutput = belt app run falai/flux-dev-lora --input $tmpJson 2>&1

    # Extract image URL from output
    $imageUrl = $null
    foreach ($line in $beltOutput) {
        if ($line -match 'https?://[^\s"]+\.(png|jpg|jpeg|webp)') {
            $imageUrl = $matches[0]
            break
        }
    }

    if ($imageUrl) {
        try {
            Invoke-WebRequest -Uri $imageUrl -OutFile $outFile -UseBasicParsing
            Write-Host "  [OK]   $($p.file).png saved" -ForegroundColor Green
            $successCount++
        } catch {
            Write-Host "  [FAIL] Download failed for $($p.file): $_" -ForegroundColor Red
            $failedProducts += $p.file
        }
    } else {
        Write-Host "  [FAIL] No URL found for $($p.file)" -ForegroundColor Red
        Write-Host "         Output: $($beltOutput -join ' | ')" -ForegroundColor DarkRed
        $failedProducts += $p.file
    }

    Start-Sleep -Seconds 2
}

# Cleanup
if (Test-Path $tmpJson) { Remove-Item $tmpJson }

Write-Host "`n=== Done: $successCount/$totalProducts images generated ===" -ForegroundColor Cyan
if ($failedProducts.Count -gt 0) {
    Write-Host "Failed: $($failedProducts -join ', ')" -ForegroundColor Red
}
