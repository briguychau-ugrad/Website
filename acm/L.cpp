// UBC+

#include <iostream>
#include <map>
#include <queue>
#include <vector>
#include <algorithm>
#include <utility>
#include <cmath>
#include <cstdio>
#include <cstring>
#include <string>

using namespace std;

#define msc map<string, coord>
#define msld map<string, ld>
#define msmsld map<string, msld >
#define psd pair<string, double>
#define msb map<string, bool>
#define pqpsd priority_queue<psd, vector<psd >, comp>
#define ll long long
#define ld long double

struct comp {
	bool operator() (psd & a, psd & b) {
		return a.second > b.second;
	}
};

struct coord {
	ll x;
	ll y;
	ll z;
	coord() : x(0), y(0), z(0) {}
	coord(ll a, ll b, ll c) : x(a), y(b), z(c) {}
};

ld dist(coord a, coord b) {
	return sqrt(1.0 * ((a.x - b.x) * (a.x - b.x) + (a.y - b.y) * (a.y - b.y) + (a.z - b.z) * (a.z - b.z)));
}

int main() {
	
	int t; cin >> t;
	
	for (int tc = 1; tc <= t; ++tc) {
		printf("Case %d:\n", tc);

		int p; cin >> p;
		msc planets;
		for (int i = 0; i < p; ++i) {
			string s; ll a, b, c;
			cin >> s >> a >> b >> c;
			planets[s] = coord(a, b, c);
		}
		
		msmsld travel;
		for (msc::iterator ita = planets.begin(); ita != planets.end(); ++ita) {
			msld temp;
			travel[ita->first] = temp;
			for (msc::iterator itb = planets.begin(); itb != planets.end(); ++itb) {
				travel[ita->first][itb->first] = dist(ita->second, itb->second);
			}
		}
		
		int w; cin >> w;
		for (int i = 0; i < w; ++i) {
			string a, b; cin >> a >> b;
			travel[a][b] = 0.0;
		}
		
		int q; cin >> q;
		for (int qq = 0; qq < q; ++qq) {
			string from, to; cin >> from >> to;
			ld maxDist = dist(planets[from], planets[to]);
			
			msb visited;
			
			pqpsd pq;
			pq.push(make_pair(from, 0.0));
			
			while (!pq.empty()) {
				psd curr = pq.top();
				pq.pop();
				if (curr.second > maxDist) break;
				if (curr.first == to) {
					maxDist = curr.second;
					break;
				}
				if (visited[curr.first]) continue;
				visited[curr.first] = true;
				ld d2end = dist(planets[curr.first], planets[to]) + curr.second;
				if (d2end < maxDist) maxDist = d2end;
				
				for (msmsld::iterator ita = travel.begin(); ita != travel.end(); ++ita) {
					msld whs = ita->second;
					for (msld::iterator itb = whs.begin(); itb != whs.end(); ++itb) {
						if (itb->second != 0.0) continue;
						ld distTo = curr.second + dist(planets[curr.first], planets[ita->first]);
						pq.push(make_pair(itb->first, distTo));
					}
				}
			}
			
			
			printf("The distance from %s to %s is %lld parsecs.\n", from.c_str(), to.c_str(), (ll)(maxDist + 0.5));
			
		}
	}
	return 0;
}

