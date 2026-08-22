<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected function ensureTableExists()
    {
        if (!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category')->default('tutorials');
                $table->text('excerpt')->nullable();
                $table->longText('content');
                $table->string('image')->nullable();
                $table->string('reading_time')->default('5 min read');
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
            });
        }

        if (Blog::count() === 0) {
            Blog::create([
                'title' => 'Ultimate Guide: How to Setup IPTV on Smart TV',
                'slug' => 'ultimate-guide-how-to-setup-iptv-on-smart-tv',
                'category' => 'tutorials',
                'image' => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'Learn the step-by-step process to configure BestLiveIPTV on Samsung, LG, and Android Smart TVs in under 5 minutes.',
                'content' => "Setting up BestLiveIPTV on your Smart TV is quick and easy. Follow this simple guide to start watching premium live TV immediately.\n\n### Step 1: Download an IPTV Player\nSearch your Smart TV app store for recommended apps like **IBO Player**, **IPTV Smarters Pro**, or **TiviMate**.\n\n### Step 2: Enter Your Login Details\nOnce you subscribe to one of our packages, you will receive your M3U URL, Xtream Codes Username, Password, and Server URL via email.\n\n### Step 3: Enjoy Premium Streaming\nOpen your app, enter the credentials provided, and your playlist will load instantly with EPG TV guide!",
                'reading_time' => '5 min read',
                'is_featured' => true,
                'is_active' => true,
                'published_at' => now(),
            ]);

            Blog::create([
                'title' => 'New Channels Added - January 2026 Update',
                'slug' => 'new-channels-added-january-2026-update',
                'category' => 'updates',
                'image' => 'https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'We have just added over 150 new 4K and FHD channels across Sports, Movies, and Entertainment categories.',
                'content' => "We are thrilled to announce our latest channel lineup update for January 2026! Our team has been working tirelessly to expand our streaming servers and bring you even more high-definition entertainment.\n\n### What's New:\n- **150+ New Channels:** Expanded coverage in US, UK, Canada, and European sports and movie networks.\n- **Enhanced 4K Streams:** Upgraded bitrate for top tier live sports events without buffering.\n- **99.9% Uptime Guarantee:** New load balancing servers deployed globally.\n\nEnjoy seamless streaming with BestLiveIPTV!",
                'reading_time' => '3 min read',
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now()->subDays(2),
            ]);

            Blog::create([
                'title' => '5 Tips to Eliminate Buffering on Live Streams',
                'slug' => '5-tips-to-eliminate-buffering-on-live-streams',
                'category' => 'tips',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=1000&q=80',
                'excerpt' => 'Discover how to optimize your home Wi-Fi network and streaming device settings for crystal clear, lag-free IPTV viewing.',
                'content' => "Experiencing occasional lag? Here are 5 quick tips to ensure smooth 4K streaming:\n\n1. **Use an Ethernet Cable:** Wired connections are always more stable than Wi-Fi.\n2. **Use a 5GHz Wi-Fi Band:** If using Wi-Fi, connect to your router's 5GHz network instead of 2.4GHz.\n3. **Clear App Cache:** Regularly clear the cache of your IPTV player app to free up memory.\n4. **Check Your VPN Settings:** If using a VPN, connect to a server geographically closest to you.\n5. **Restart Your Router:** A simple reboot can refresh your DNS and routing paths.",
                'reading_time' => '4 min read',
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now()->subDays(5),
            ]);
        } else {
            $defaultImages = [
                'https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=1000&q=80',
                'https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?auto=format&fit=crop&w=1000&q=80',
                'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=1000&q=80',
                'https://images.unsplash.com/photo-1546054454-aa26e2b734c7?auto=format&fit=crop&w=1000&q=80',
                'https://images.unsplash.com/photo-1600132806370-bf17e65e942f?auto=format&fit=crop&w=1000&q=80',
                'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=1000&q=80',
            ];
            
            $allPosts = Blog::all();
            foreach ($allPosts as $index => $post) {
                if (empty($post->image) || $post->image === 'null' || (!str_contains($post->image, 'http') && !str_contains($post->image, '/images/'))) {
                    $post->update([
                        'image' => $defaultImages[$index % count($defaultImages)]
                    ]);
                }
            }
        }
    }

    public function index(): View
    {
        $this->ensureTableExists();
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        $this->ensureTableExists();
        return view('admin.blogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureTableExists();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'category' => 'required|string|in:tutorials,updates,tips,news',
            'reading_time' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:5120',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        if (empty($validated['reading_time'])) {
            $validated['reading_time'] = '5 min read';
        }
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['published_at'] = now();

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/blogs'), $filename);
            $validated['image'] = '/images/blogs/' . $filename;
        }

        if ($validated['is_featured']) {
            Blog::where('id', '>', 0)->update(['is_featured' => false]);
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog): View
    {
        $this->ensureTableExists();
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $this->ensureTableExists();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'category' => 'required|string|in:tutorials,updates,tips,news',
            'reading_time' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:5120',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/blogs'), $filename);
            $validated['image'] = '/images/blogs/' . $filename;
        } elseif (empty($validated['image'])) {
            $validated['image'] = $blog->image;
        }

        if ($validated['is_featured'] && !$blog->is_featured) {
            Blog::where('id', '!=', $blog->id)->update(['is_featured' => false]);
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function toggleActive(Blog $blog): RedirectResponse
    {
        $blog->update(['is_active' => !$blog->is_active]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog status updated!');
    }
}
